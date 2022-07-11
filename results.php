Федоров Віталій Миколайович КІУКІ-19-2 Варіант №8<?php
    include('connect.php');
    if (isset($_POST["name"]))
    {
            $name = $_POST["name"];
            $sql = "SELECT name, start, stop, in_traffic, out_traffic FROM seanse INNER JOIN client ON FID_Client = ID_Client WHERE name=:name";
            echo "<h4>Статистика работы в сети: ".$name."</h4>";
            $sth = $dbh->prepare($sql);

            $sth->execute(array(':name' => $name));
            $txt = "<table>";
            $txt .= " <tr>
             <th>Name</th>
             <th> Start time  </th>
             <th> Stop time </th>
             <th> In Traffic </th>
             <th> Out Traffic </th>
            </tr> ";
            while ($data = $sth->fetch()) {
                $txt .= " <tr>
                 <td> {$data['name']} </td>
                 <td> {$data['start']}  </td>
                 <td> {$data['stop']} </td>
                 <td> {$data['in_traffic']} </td>
                 <td> {$data['out_traffic']} </td>
                </tr> ";
            }
            $txt .= "</table>";
            echo $txt;
    }
    elseif (isset($_POST["start"])) {
        statisticByDate($_POST["start"], $_POST["stop"]);
    }
    else
    {
        echo "<h4>список клиентов с отрицательным балансом счета:</h4>";
        $sql = "SELECT name, login, password, IP, balance FROM client WHERE balance < 0";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $txt = "<table>";
        $txt .= " <tr>
         <th> Name  </th>
         <th> Login  </th>
         <th> Password </th>
         <th> IP </th>
         <th> Balance </th>
        </tr> ";
        while ($data = $sth->fetch()) {
            $txt .= " <tr>
             <td> {$data['name']}  </td>
             <td> {$data['login']}  </td>
             <td> {$data['password']} </td>
             <td> {$data['IP']} </td>
             <td> {$data['balance']} </td>
            </tr> ";
        }
        $txt .= "</table>";
        echo $txt;
    }

    function statisticByDate($start, $stop): void
    {
        include('connect.php');
        $sth = $dbh->prepare("
        SELECT `name`, `start`, stop, in_traffic, out_traffic 
        FROM seanse inner join client on FID_Client = ID_Client 
        WHERE `start` BETWEEN :start AND :stop OR `stop` BETWEEN :start AND :stop
");
        $sth->execute(["start" => $start, "stop" => $stop]);
        $txt = "<table>";
        $txt .= " <tr>
         <th> Name  </th>
         <th> Start time  </th>
         <th> Stop time </th>
         <th> In Traffic </th>
         <th> Out Traffic </th>
        </tr> ";
        while ($data = $sth->fetch()) {
            $txt .= " <tr>
             <td> {$data['name']}  </td>
             <td> {$data['start']}  </td>
             <td> {$data['stop']} </td>
             <td> {$data['in_traffic']} </td>
             <td> {$data['out_traffic']} </td>
            </tr> ";
        }
        $txt .= "</table>";
        echo json_encode($txt);
    }