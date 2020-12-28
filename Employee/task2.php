<?php
//*********************Array***********************//

$workers=[
    [
        'name'=>'Ivan Stepanovich',
        'department'=>'Administration',
        'gender'=>'Man',
        'note'=>[
            'position'=>'Accountant',
            'salary'=>45000
        ]
    ],
    [
        'name'=>'Svetlana Urievna',
        'department'=>'Warehouse',
        'gender'=>'Women',
        'note'=>[
            'position'=>'Managing Director',
            'salary'=>70000
        ]
    ],
    [
        'name'=>'Boris Borisovich',
        'department'=>'Legal department',
        'gender'=>'Man',
        'note'=>[
            'position'=>'Lawyer',
            'salary'=>50000
        ]
    ],
    [
        'name'=>'Leonid Ivanovich',
        'department'=>'Legal department',
        'gender'=>'Man',
        'note'=>[
            'position'=>'Chief Visionary Officer',
            'salary'=>24000
        ]
    ],
    [
        'name'=>'Serget Borisovich',
        'department'=>'Administration',
        'gender'=>'Man',
        'note'=>[
            'position'=>'Chief Financial Officer',
            'salary'=>35000
        ]
    ],
    [
        'name'=>'Gleb Petrovich',
        'department'=>'Orders',
        'gender'=>'Man',
        'note'=>[
            'position'=>'Accountant',
            'salary'=>40000
        ]

    ]
];
//******************************************************//


//***************EmptyNewArray***************************//

$workerGroup=[];

//*******************************************************//



//*****************ArrayGroup****************************//
foreach ($workers as $department=>$person ) {
      if($workerGroup!==$person['department']){
        $workerGroup[$person['department']]['items'][]=$person;
    }else{
        array_push($workerGroup[$person['department']]['items'], $person);
        // $workerGroup[$person[department]]['salarySum']=+$person[note][salary];

    }
    $workerGroup[$person['department']]['salarySum']+=$person['note']['salary'];
}
//*****************************************************//


//*******************SortingForsalarySum*********************//


uasort($workerGroup, function ($a, $b) {
   return $b['salarySum'] - $a['salarySum'];
});



//*********Sorting for names***************************//
foreach ($workerGroup as $department=>$person){
       sort($person);
   }


//****************************************************//



//***********Функция для распечатки******************//
debuger($workerGroup);

function debuger($data){
   echo '<pre>';
   print_r($data);
   echo '</pre>';
}
//****************************************************//
?>
