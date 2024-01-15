<x-app-layout>
    {{-- BCS3453 [PROJECT]-SEMESTER 2324/1
 Student ID: CB21134
 Student Name: Yattish A/L Jaya Nanda Kumar --}}
    <div class="container-fluid mt-4">
        
           
                    
                    <div class="d-flex">
                        <div class="d-flex w-50 justify-content-around align-items-center mb-5">
                            <div class="card card border border-dark shadow-1 mb-3 w-75 " style="max-width: 18rem;">
                                <div class="card-body">
                                    <h6 class="card-title" style="font-size: 15px; color:rgb(131, 131, 131)">Total Balance </h6>
                                    @php
                                        $totalSaving = 0;
                                        $totalIncome = 0;
                                        $totalExpense = 0;
                                        foreach ($categoryList as $category) {
                                            if ($category->categoryType == 'savings') {
                                                $totalSaving += $category->categoryAmount;
                                            } elseif ($category->categoryType == 'income') {
                                                $totalIncome += $category->categoryAmount;
                                            } elseif ($category->categoryType == 'expense') {
                                                $totalExpense -= $category->categoryAmount;
                                            }
                                        }

                                    @endphp
                                    <p class="card-text" style="font-size: 28px; color:rgb(0, 162, 226)"> RM{{$totalSaving}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-50 justify-content-around align-items-center mb-5">
                            <div class="card border border-dark shadow-0 mb-3 w-75" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 15px; color:rgb(131, 131, 131)">Total Expenses : </h5>
                                    <p class="card-text" style="font-size: 28px; color:rgb(255, 17, 0)"> RM{{ abs($totalExpense)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-50 justify-content-around align-items-center mb-5">
                            <div class="card border border-dark shadow-0 mb-3 w-75" style="max-width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 15px; color:rgb(131, 131, 131)">Total Income : </h5>
                                    <p class="card-text" style="font-size: 28px; color:rgb(38, 255, 0)"> RM{{$totalIncome}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="card" style="width: 86%">
                        <div class="card-body">
                          <h5 class="card-title">Graph Overview</h5>
                          <canvas id="expenseChart" width="300" height="150"></canvas>
                        </div>
                      </div>
                    </div>
                    
                 

                    
                   
    </div>


    <script>

 var data = {!! json_encode($data) !!};

const aggregatedData = {};

data.forEach(entry => {
  const month = entry.transactionMonth;
  
  if (!aggregatedData[month]) {
    aggregatedData[month] = {
      month,
      expenses: 0,
      income: 0 
    }
  }
  
  aggregatedData[month].expenses += entry.expenses;
  aggregatedData[month].income += entry.income;
});

const chartData = Object.values(aggregatedData);
      

document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('expenseChart').getContext('2d');
    console.log(data); // Add this line
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(e => e.month), 
            datasets: [{
                label: 'Expenses',
                borderColor: 'rgba(255, 17, 0, 1)',
                backgroundColor: 'rgba(255, 17, 0, 0.5)',
                data: chartData.map(e => e.expenses),
                pointRadius: 5,
                pointBackgroundColor: 'rgba(255, 17, 0, 1)',
                pointBorderColor: 'rgba(255, 17, 0, 1)',
                pointHoverRadius: 7,
            },
            {
                label: 'Income',
                borderColor: 'rgba(38, 255, 0, 1)',
                backgroundColor: 'rgba(38, 255, 0, 0.5)',
                data: chartData.map(e => e.income),
                pointRadius: 5,
                pointBackgroundColor: 'rgba(38, 255, 0, 1)',
                pointBorderColor: 'rgba(38, 255, 0, 1)',
                pointHoverRadius: 7,
            }],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});

    </script>

</x-app-layout>
