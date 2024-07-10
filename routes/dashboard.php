<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header('Location: ../');
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

$status = $userdata['status'] == 0 ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <style>
        #backbtn, #logoutbtn {
            padding: 5px;
            font-size: 15px;
            background-color: rgb(18, 66, 180);
            color: white;
            border: 2px solid black;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
        }
        #backbtn:hover, #logoutbtn:hover {
        background-color: red;
        color: white;
    }

        

        #backbtn {
            float: left;
        }

        #logoutbtn {
            float: right;
        }

        #Profile, #Group {
            background-color: white;
            padding: 20px;
        }

        #Profile {
            width: 30%;
            float: left;
        }

        #Group {
            width: 60%;
            float: right;
        }

        #votebtn {
            padding: 5px;
            font-size: 15px;
            background-color: rgb(29, 91, 121);
            color: white;
            border: 2px solid white;
            border-radius: 5px;
        }

        #mainpanel {
            padding: 10px;
        }

        #voted {
            padding: 5px;
            font-size: 15px;
            background-color: green;
            color: white;
            border: 2px solid white;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>
        <div id="Profile">
            <?php if (isset($userdata['photo']) && file_exists("../uploads/" . $userdata['photo'])): ?>
                <center><img src="../uploads/<?php echo htmlspecialchars($userdata['photo']); ?>" height="100" width="100"></center><br><br>
            <?php else: ?>
                <p>No photo available</p>
            <?php endif; ?>
            <b>Name:</b> <?php echo htmlspecialchars($userdata['name']); ?><br><br>
            <b>Mobile:</b> <?php echo htmlspecialchars($userdata['mobile']); ?><br><br>
            <b>Address:</b> <?php echo htmlspecialchars($userdata['address']); ?><br><br>
            <b>Status:</b> <?php echo $status; ?><br><br>
        </div>
        <div id="Group">
            <?php if ($groupsdata): ?>
                <?php foreach ($groupsdata as $group): ?>
                    <div>
                        <img style="float:right" src="../uploads/<?php echo htmlspecialchars($group['photo']); ?>" height="100" width="100">
                        <b>Group Name: </b> <?php echo htmlspecialchars($group['name']); ?><br><br>
                        <b>Votes: </b> <?php echo htmlspecialchars($group['votes']); ?><br><br>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo htmlspecialchars($group['votes']); ?>">
                            <input type="hidden" name="gid" value="<?php echo htmlspecialchars($group['id']); ?>">
                            <?php if ($userdata['status'] == 0): ?>
                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                            <?php else: ?>
                                <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
