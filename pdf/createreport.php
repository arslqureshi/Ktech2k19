<?php
    require 'fpdf.php';
    include '../Include/connection.php';
    $id=$_GET['id'];
    $sql="select * from competition where Competition_Id='$id'";
    $event_run=mysqli_query($conn,$sql);

    $sql="select * from team where Competition_Id='$id'";
    $team_run=mysqli_query($conn,$sql);
    $member=0;
    $judge=0;
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage('L','A4',0);
     $pdf->SetFont('Arial','B',14);
    while($run=mysqli_fetch_assoc($event_run)){
        $pdf->Cell(0,0,$run['Competition_Name'],0,0,'C');
        $pdf->Ln(20);
        $pdf->Cell(30,10,'Team Name',1,0,'C');
        $pdf->Cell(40,10,'Team Email',1,0,'C');
        $member=$run['Members_Per_Team'];
        $judge=$run['Total_Judges'];
        for($i=1;$i<=$run['Members_Per_Team'];$i++){
            $pdf->Cell(40,10,'Team member',1,0,'C');
        }
        for($i=1;$i<=$run['Total_Judges'];$i++){
            $pdf->Cell(20,10,'marks',1,0,'C');
        }
    }
    $pdf->Cell(30,10,'Position',1,0,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',10);
    while($run=mysqli_fetch_assoc($team_run)){
        $pdf->Cell(30,10,$run['Team_Name'],1,0,'C');
        $pdf->Cell(40,10,$run['Team_Email'],1,0,'C');
       // for($i=0;$i<$run['No_Of_Participant'];$i++){
            $team_id=$run['Team_Id'];
            $quer="select * from participant where Team_Id='$team_id'";
            $std_run=mysqli_query($conn,$quer);
            while($std=mysqli_fetch_assoc($std_run)){
                $pdf->Cell(40,10,$std['Participant_Name'],1,0,'C');
                $left=$member-$run['No_Of_Participant'];
                for($j=0;$j<$left;$j++){
                    $pdf->Cell(40,10,"",1,0,'C');
                }
            }
            for($k=0;$k<$judge;$k++){
                $pdf->Cell(20,10,'',1,0,'C');
            }
            $pdf->Cell(30,10,'',1,0,'C');
        //}
        $pdf->Ln(10);
    }
    $pdf->Ln(20);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,0,'Run Time Registered Students',0,0,'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','',10);

    for($i=0;$i<20;$i++){
        $pdf->Cell(30,10,'',1,0,'C');
        $pdf->Cell(40,10,'',1,0,'C');
        for($j=1;$j<=$member;$j++){
            $pdf->Cell(40,10,'',1,0,'C');
        }
        for($k=1;$k<=$judge;$k++){
            $pdf->Cell(20,10,'',1,0,'C');
        }
        $pdf->Cell(30,10,'',1,0,'C');
        $pdf->Ln(10);
    }
    
    //while($run=mysqli_fetch_assoc($event_run)){
        
    //}
    //$pdf->Cell(30,10,$run['Members_Per_Team'],1,0,'C');
    //$pdf->Cell(30,10,'Team Name',1,0,'C');
    //$pdf->Cell(30,10,'Team Email',1,0,'C');
    $pdf->Output();  
?>