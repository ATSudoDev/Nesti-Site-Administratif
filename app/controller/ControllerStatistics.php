<?php

class ControllerStatistics extends BaseController
{

    public function initialize()
    {

        // RESTRICTION 
        if (array_search("admins", $_SESSION["roles_user"]) === false) {
            header('Location:' . BASE_URL . "forbidden");
            exit();
        } else {

            // COMMANDS
            $todayDate = new DateTime;
            $todayDate->add(DateInterval::createFromDateString("-10 days"));

            for ($days = 9; $days >= 0; $days--) {

                $dayDate = date('Y-m-d', strtotime("-" . $days . " days"));


                $commandsByDay = CommandDAO::getCommandsByDay($dayDate);
                $packagesByDay = PackageDAO::getPackagesByDay($dayDate);

                $totalSold = 0;
                $totalPurchased = 0;

                foreach ($commandsByDay as $command) {
                    $totalSold += $command->getTotalPriceCommand();
                }

                foreach ($packagesByDay as $package) {
                    $totalPurchased += $package->getPrice_unite_package() * $package->getQuantity_bought_package();
                }

                $totalPurchasedPerDay[] = $totalPurchased;
                $totalSoldPerDay[] = $totalSold;
                $arrayDates[] = substr($dayDate, 5);
            }

            // COMMANDS
            $commands = CommandDAO::readAllCommands();
            usort($commands, function ($command1, $command2) { // sort the array DESC according to the price of the order
                return $command2->getTotalPriceCommand() <=> $command1->getTotalPriceCommand();
            });
            $commands = array_slice($commands, 0, 10);

            // LOGS CONSULTATION
            $allLogsUsers = LogsUserDAO::readAllLogsUsers();
            foreach ($allLogsUsers as $logUser) {
                $format = 'Y-m-d H:i:s';
                $logUserDate = DateTime::createFromFormat($format, $logUser->getDate_connection_log_user()); // format each connection date
                $logByHours[$logUserDate->format('H')][] = $logUser; // sort the list of the logs by hours (hour is the key of the array $hoursLog)
            }
            foreach ($logByHours as $key => $logs) {
                $connectionPerHour[] = (object) array('name' => $key, 'data' => count($logs)); // count the number of logs for a given hour
            }
            array_multisort($connectionPerHour, SORT_ASC);


            // USERS
            $users = UserDAO::readAllUsers(); // get all the users
            usort($users, function ($user1, $user2) { // sort the array DESC according to the number of logs for each user
                return count($user2->getConnectionsUser()) <=> count($user1->getConnectionsUser());
            });
            $users = array_slice($users, 0, 10); // we keep the first 10

            // CHIEFS
            $chiefs = UserDAO::readAllUsers();
            usort($chiefs, function ($chief1, $chief2) { // sort the array DESC according to the average grade of recipes for each chief
                return $chief2->getGradeChief() <=> $chief1->getGradeChief();
            });
            $chiefs = array_slice($chiefs, 0, 10); // we keep the first 10


            // RECIPES 
            $recipes = RecipeDAO::readAllRecipes();
            usort($recipes, function ($recipe1, $recipe2) { // sort the array DESC according to the grade of the recipe
                return $recipe2->getGradeRecipe() <=> $recipe1->getGradeRecipe();
            });
            $recipes = array_slice($recipes, 0, 10); // we keep the first 10


            // ARTICLES
            $articles = ArticleDAO::readAllArticles();

            $articlesName = [];
            $articlesOutOfStock = [];

            foreach ($articles as $article) {
                if ($article->getStockArticle() <= 0) {
                    $articlesOutOfStock[] = $article;
                }
                $articlesName[] = $article->getQuantity_unite_article() . ' ' . $article->getUnitArticle() . ' de ' . $article->getNameProduct();    
            }

            $articlesSold = [];
            $articlesBought = [];

            foreach ($articles as $article) {
                $articlesSold[] = $article->getTotalSalesArticle();
                $articlesBought[] = $article->getTotalBoughtArticle();
            }

            // RETURN DATA        
            var_dump($articlesName);
            $this->_data["totalSoldPerDay"] = $totalSoldPerDay;
            $this->_data["totalPurchasedPerDay"] = $totalPurchasedPerDay;
            $this->_data["arrayDates"] = $arrayDates;
            $this->_data["top10commands"] = $commands;
            $this->_data["connectionPerHour"] = $connectionPerHour;
            $this->_data["top10ConnectedUsers"] = $users;
            $this->_data["top10Recipes"] = $recipes;
            $this->_data["top10Chiefs"] = $chiefs;
            $this->_data["articlesName"] = $articlesName;
            $this->_data["articlesSold"] = $articlesSold;
            $this->_data["articlesBought"] = $articlesBought;
            $this->_data["articlesOutOfStock"] = $articlesOutOfStock;
        }
    }
}
