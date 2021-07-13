// Orders
const el = document.getElementById('toastCommands');

const data = {

    categories: [
        arrayDates[0],
        arrayDates[1],
        arrayDates[2],
        arrayDates[3],
        arrayDates[4],
        arrayDates[5],
        arrayDates[6],
        arrayDates[7],
        arrayDates[8],
        arrayDates[9]
    ],

    series: [{
        name: 'Cost',
        data: totalPurchasedPerDay,
    }, {
        name: 'Sells',
        data: totalSoldPerDay,
    }],
};

const options = {
    chart: {
        title: '',
        width: 650,
        height: 400
    },
    xAxis: {
        pointOnColumn: false,
        title: {
            text: 'Date'
        }
    },
    yAxis: {
        title: 'Euros'
    },
};

const chartLog = toastui.Chart.lineChart({
    el,
    data,
    options
});


// Website Consultation
const el1 = document.getElementById('toastConnection');

const dataConnectionLogPerHour = {
    categories: ['Connection'],
    series: connectionPerHour
}

const optionsConnectionLog = {
    chart: {
        title: '',
        width: 650,
        height: 500
    },
    legend: {
        visible: true
    },
    series: {
        dataLabels: {
            visible: true,
            anchor: 'outer',
            formatter: (value) => value,
            pieSeriesName: {
                visible: true,
            },
        },
        radiusRange: {
            inner: '0%',
            outer: '100%',
        }
    }
};

const chartConection = toastui.Chart.pieChart({
    el: el1,
    data: dataConnectionLogPerHour,
    options: optionsConnectionLog
});

// Articles
const el2 = document.getElementById('toastArticles');

var clésDenses = Object.keys(articlesName);

const dataArticle = {
    categories: clésDenses,
    series: [{
        name: 'Ventes',
        data: articlesSold,
    },
    {
        name: 'Coûts',
        data: articlesBought,
    }
    ],
};
const optionsArticle = {
    chart: {
        title: "",
        width: 900,
        height: 400
    },
    legend: {
        visible: true,
    },
    xAxis: {
        title: "Noms articles",
    },
    yAxis: {
        title: "Euros",
    }
};

const chartArticle = toastui.Chart.columnChart({
    el: el2,
    data: dataArticle,
    options: optionsArticle
});