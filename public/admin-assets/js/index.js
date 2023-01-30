$(function () {
  "use strict";
  
  // Chart 1 - Last Week Revenue 
  var ctx = document.getElementById('dashboard2-chart-3').getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke1.addColorStop(0, '#008cff');
  gradientStroke1.addColorStop(1, 'rgba(22, 195, 233, 0.1)');

  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Revenue',
        data: [3, 30, 10, 10, 22, 12, 5],
        pointBorderWidth: 2,
        pointHoverBackgroundColor: gradientStroke1,
        backgroundColor: gradientStroke1,
        borderColor: 'transparent',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        position: 'bottom',
        display: false
      },
      tooltips: {
        displayColors: false,
        mode: 'nearest',
        intersect: false,
        position: 'nearest',
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },

    }
  });

  // Chart 2 - Orders Summary
  var ctx = document.getElementById("dashboard2-chart-4").getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke1.addColorStop(0, '#ee0979');
  gradientStroke1.addColorStop(1, '#ff6a00');

  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke2.addColorStop(0, '#283c86');
  gradientStroke2.addColorStop(1, '#39bd3c');

  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke3.addColorStop(0, '#7f00ff');
  gradientStroke3.addColorStop(1, '#e100ff');

  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Completed", "Pending", "Process"],
      datasets: [{
        backgroundColor: [
          gradientStroke1,
          gradientStroke2,
          gradientStroke3
        ],

        hoverBackgroundColor: [
          gradientStroke1,
          gradientStroke2,
          gradientStroke3
        ],

        data: [50, 50, 50],
        borderWidth: [0, 0, 0]
      }]
    },
    options: {
      cutoutPercentage: 85,
      legend: {
        position: 'bottom',
        display: true,
        labels: {
          boxWidth: 8
        }
      },
      tooltips: {
        displayColors: false,
      },
    }
  });
});