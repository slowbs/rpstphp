<?php
include 'functions.php';
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
include 'db.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) as tnum, Max(year), Max(ep2) from 
        (
         SELECT *,max(year), max(ep) as ep2 FROM information_schema.tables, ssj.year WHERE table_schema = 'ssj' 
        and year = (select max(year) from ssj.year) GROUP by table_name) as fuk;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $newyear = $row['Max(year)'];
            $newep = $row['Max(ep2)']+3;
            $tnum = $row['tnum'];
            //echo {$newep}_$newyear;
            $sql = "INSERT INTO year (year,ep) VALUES ($newyear,$newep);
             RENAME TABLE `table $tnum` TO form_{$newep}_$newyear;
            DELETE FROM `form_{$newep}_$newyear` WHERE `COL 14` = 'status';
            ALTER TABLE form_{$newep}_$newyear add column id int PRIMARY key NOT NULL AUTO_INCREMENT first;
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 1` pa varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 2` lumdub varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 3` name varchar(200);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 4` gane varchar(15);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 5` data varchar(15);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 6` koon1 decimal(10,2);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 7` koon2 decimal(10,2);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 8` koon3 decimal(10,2);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 9` gane1 varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 10` gane2 varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 11` gane3 varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 12` gane4 varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 13` gane5 varchar(10);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 14` status int(5);
            ALTER TABLE form_{$newep}_$newyear CHANGE `COL 15` kor int(3);
            CREATE table sync as select year.year, year.ep, form_{$newep}_$newyear.id, pa.type FROM form_{$newep}_$newyear INNER join year
inner join pa where not exists 
(select * from ap1
            where ap1.year = year.year and ap1.ep = year.ep and ap1.type = pa.type and ap1.rid = form_{$newep}_$newyear.id)
            ORDER by year.year, year.ep, pa.type, form_{$newep}_$newyear.id;
INSERT INTO ap1(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap2(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap3(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap4(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap5(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap6(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap7(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap8(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap9(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap10(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap11(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap12(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap13(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap14(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap15(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap16(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap17(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap18(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap19(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap20(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap21(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap22(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
INSERT INTO ap23(`year`,`ep`, `rid`, `type`) select sync.year, sync.ep, sync.id, sync.type FROM sync;
drop table sync;
INSERT INTO total_score (`name`,`apid`,`time`, `ep`,`type`) 
            select ampher.name , ampher.id, year.year, year.ep, pa.type from ampher INNER join year
            inner join pa where not exists
            (select time from total_score
            where total_score.time = year.year and total_score.ep = year.ep)
            ORDER by year.year, year.ep, pa.type, ampher.id ;
INSERT INTO log (`apid`,`name`,`year`, `ep`,`type`)
            SELECT ampher.id, ampher.name, year.year, year.ep, pa.type from ampher inner join year 
            inner join pa where not EXISTS
            (select time, ep from log 
	        where log.year = year.year AND log.ep = year.ep and log.type = pa.type)
            ORDER by year.year, year.ep, pa.type, ampher.id;
            ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header("Location:year.php");
        }  
    }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
?>