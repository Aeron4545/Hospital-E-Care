<?php
session_start();
if (isset($_GET['logout'])) {
  session_unset();

  session_destroy();

  header("Location: /E Care/login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styling.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      body {
    background-image: url("1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
}
      .header {
      background-color: #16f5f5;
      padding: 10px;
      color: #fff;
      text-align: right;
    }
    .header button {
      margin-left: 10px;
      padding: 5px 10px;
      background-color: #4CAF50;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
    }
    .header button:hover {
      background-color: #45a049;
    }
    body {
      margin: 0;
      padding: 0;
    }
    </style>
</head>
<body>
<div class="header">
        <button onclick="window.location.href='data.php'">Home</button>
        <button onclick="window.location.href='my_bookings.php'">My Bookings</button>
        <button onclick="window.location.href='login.php'">Logout</button>
</div>
</div>
    <p1>WELCOME BACK!</p1>
    <div class="row">
      <div class="column">
      <div class="card">
        <form method="post">
        <input type="submit" name="button1"
                class="button" value="Select" />
        </form>
           <h3>Cardiology</h3>
        </div>
      </div>
    
      <div class="column">
        <div class="card">
        <form method="post">
        <input type="submit" name="button2"
                class="button" value="Select" />
        </form>
          <h3>Gyaenac</h3>
        </div>
      </div>
      <div class="column">
        <div class="card">
        <form method="post">
        <input type="submit" name="button3"
                class="button" value="Select" />
        </form>
          <h3>Psychiatrist</h3>
        </div>
      </div>
      
      <div class="column">
        <div class="card">
        <form method="post">
        <input type="submit" name="button4"
                class="button" value="Select" />
        </form>
          <h3>Physician</h3>
        </div>
      </div>
      <div class="column">
        <div class="card">
        <form method="post">
        <input type="submit" name="button5"
                class="button" value="Select" />
        </form>
          <h3>ENT</h3>
        </div>
      </div>
    </div>
    <div class="backdrop" id="feedbackBackdrop"></div>
    <div id="feedbackModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" onclick="closeFeedbackModal()">&times;</span>
      <h2>Feedback for Doctor: <span id="doctorName"></span></h2>
      <div id="feedbackContent">
      </div>
    </div>
  </div>
    <?php
        if(isset($_POST['button1'])) {
    
$servername="localhost";
$username="root";
$password="";
$dbName='doctors';

$conn=new mysqli($servername ,$username,$password,$dbName);
if($conn->connect_errno){
  echo "connection failed";
  exit();
}
    $sql = "SELECT * FROM doc where department='Cardiology'";
    $result = $conn->query($sql);
    $total=mysqli_num_rows($result);
    ?>
    <table border="5px"> 
	  
			  <th> Sno </th>  
			  <th> Name </th> 
			  <th> Experience </th> 
        <th> Gender </th> 
        <th> Price </th>
        <th> Availability </th>
        <th> Details </th>
        <th> Provide Feedback </th>
        <th> Feedbacks </th> 
        <th> Book </th>    
	  </tr> 
    <?php while($rows=$result->fetch_assoc()) 
		{ 
		?> 
		<tr> <td><?php echo $rows["sno"]; ?></td> 
		<td><?php echo $rows['NAME']; ?></td>  
		<td><?php echo $rows['experience']; ?></td> 
    <td><?php echo $rows['gender']; ?></td> 
    <td><?php echo $rows['price']; ?></td>
    <td><?php echo $rows['availability']; ?></td>  
    <td>
    <?php
    $description = $rows['Description'];
    $imagePath = "uploads/{$rows['photo']}";
    echo "<button type='button' class='details-button' onclick='showDetails(\"{$description}\", \"{$imagePath}\")'>Details</button>";
    ?>
    </td>
    <td><?php echo "<button type='button' class='details-button' onclick='giveFeedback(\"{$rows['sno']}\",\"{$rows['NAME']}\")'>Provide Feedback</button>";?></td>
    <td><?php echo "<button type='button' class='details-button' onclick='openFeedbackModal(\"{$rows['NAME']}\")'>Feedbacks</button>";?></td>
    <td><?php echo "<button type='button' class='details-button' onclick='createAppointmentForm(\"{$rows['NAME']}\", \"{$rows['sno']}\", \"{$_SESSION['user_name']}\", \"{$_SESSION['user_id']}\", \"{$rows['department']}\")'>Book</button>";?></td>
		</tr> 
	  <?php 
    } 
      }
      if(isset($_POST['button2'])) {
        $servername="localhost";
        $username="root";
        $password="";
        $dbName='doctors';
        
        $conn=new mysqli($servername ,$username,$password,$dbName);
        if($conn->connect_errno){
          echo "connection failed";
          exit();
        }
            $sql = "SELECT * FROM doc where department='gynaecology'";
            $result = $conn->query($sql);
            $total=mysqli_num_rows($result);
            ?>
            <table border="5px"> 
                <th> Sno </th> 
                <th> Name </th> 
                <th> Experience </th> 
                <th> Gender </th> 
                <th> Price </th>
                <th> Availability </th>
                <th> Details </th>
                <th> Provide Feedback </th>
                <th> Feedbacks </th>  
                <th> Book </th>    
            </tr> 
            <?php while($rows=$result->fetch_assoc()) 
            { 
            ?> 
            <tr> <td><?php echo $rows["sno"]; ?></td> 
            <td><?php echo $rows['NAME']; ?></td>  
            <td><?php echo $rows['experience']; ?></td> 
            <td><?php echo $rows['gender']; ?></td> 
            <td><?php echo $rows['price']; ?></td>
            <td><?php echo $rows['availability']; ?></td>  
            <td>
            <?php
            $description = $rows['Description'];
            $imagePath = "uploads/{$rows['photo']}";
            echo "<button type='button' class='details-button' onclick='showDetails(\"{$description}\", \"{$imagePath}\")'>Details</button>";
            ?>
            </td>
            <td><?php echo "<button type='button' class='details-button' onclick='giveFeedback(\"{$rows['sno']}\",\"{$rows['NAME']}\")'>Provide Feedback</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='openFeedbackModal(\"{$rows['NAME']}\")'>Feedbacks</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='createAppointmentForm(\"{$rows['NAME']}\", \"{$rows['sno']}\", \"{$_SESSION['user_name']}\", \"{$_SESSION['user_id']}\", \"{$rows['department']}\")'>Book</button>";?></td>
		        </tr> 
            <?php 
            } 
      }
      if(isset($_POST['button3'])) {
        $servername="localhost";
        $username="root";
        $password="";
        $dbName='doctors';
        
        $conn=new mysqli($servername ,$username,$password,$dbName);
        if($conn->connect_errno){
          echo "connection failed";
          exit();
        }
            $sql = "SELECT * FROM doc where department='psychiatrist'";
            $result = $conn->query($sql);
            $total=mysqli_num_rows($result);
            ?>
            <table border="5px"> 
                <th> Sno </th> 
                <th> Name </th> 
                <th> Experience </th> 
                <th> Gender </th> 
                <th> Price </th>
                <th> Availability </th>
                <th> Details </th>
                <th> Provide Feedback </th>
                <th> Feedbacks </th>  
                <th> Book </th>  
            </tr> 
            <?php while($rows=$result->fetch_assoc()) 
            { 
            ?> 
            <tr> <td><?php echo $rows["sno"]; ?></td> 
            <td><?php echo $rows['NAME']; ?></td>  
            <td><?php echo $rows['experience']; ?></td> 
            <td><?php echo $rows['gender']; ?></td> 
            <td><?php echo $rows['price']; ?></td>
            <td><?php echo $rows['availability']; ?></td>  
            <td>
            <?php
            $description = $rows['Description'];
            $imagePath = "uploads/{$rows['photo']}";
            echo "<button type='button' class='details-button' onclick='showDetails(\"{$description}\", \"{$imagePath}\")'>Details</button>";
            ?>
            </td>
            <td><?php echo "<button type='button' class='details-button' onclick='giveFeedback(\"{$rows['sno']}\",\"{$rows['NAME']}\")'>Provide Feedback</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='openFeedbackModal(\"{$rows['NAME']}\")'>Feedbacks</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='createAppointmentForm(\"{$rows['NAME']}\", \"{$rows['sno']}\", \"{$_SESSION['user_name']}\", \"{$_SESSION['user_id']}\", \"{$rows['department']}\")'>Book</button>";?></td>
		        </tr> 
            <?php 
            } 
      }
      if(isset($_POST['button4'])) {
        $servername="localhost";
        $username="root";
        $password="";
        $dbName='doctors';
        
        $conn=new mysqli($servername ,$username,$password,$dbName);
        if($conn->connect_errno){
          echo "connection failed";
          exit();
        }
            $sql = "SELECT * FROM doc where department='physician'";
            $result = $conn->query($sql);
            $total=mysqli_num_rows($result);
            ?>
            <table border="5px"> 
                <th> Sno </th> 
                <th> Name </th>  
                <th> Experience </th> 
                <th> Gender </th> 
                <th> Price </th>
                <th> Availability </th> 
                <th> Details </th>
                <th> Provide Feedback </th>
                <th> Feedbacks </th>  
                <th> Book </th>   
            </tr> 
            <?php while($rows=$result->fetch_assoc()) 
            { 
            ?> 
            <tr> <td><?php echo $rows["sno"]; ?></td> 
            <td><?php echo $rows['NAME']; ?></td>  
            <td><?php echo $rows['experience']; ?></td> 
            <td><?php echo $rows['gender']; ?></td> 
            <td><?php echo $rows['price']; ?></td>
            <td><?php echo $rows['availability']; ?></td>  
            <td>
            <?php
            $description = $rows['Description'];
            $imagePath = "uploads/{$rows['photo']}";
            echo "<button type='button' class='details-button' onclick='showDetails(\"{$description}\", \"{$imagePath}\")'>Details</button>";
            ?>
            </td>
            <td><?php echo "<button type='button' class='details-button' onclick='giveFeedback(\"{$rows['sno']}\",\"{$rows['NAME']}\")'>Provide Feedback</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='openFeedbackModal(\"{$rows['NAME']}\")'>Feedbacks</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='createAppointmentForm(\"{$rows['NAME']}\", \"{$rows['sno']}\", \"{$_SESSION['user_name']}\", \"{$_SESSION['user_id']}\", \"{$rows['department']}\")'>Book</button>";?></td>
		        </tr>
            <?php 
            } 
      }
      if(isset($_POST['button5'])) {
        $servername="localhost";
        $username="root";
        $password="";
        $dbName='doctors';
        
        $conn=new mysqli($servername ,$username,$password,$dbName);
        if($conn->connect_errno){
          echo "connection failed";
          exit();
        }
            $sql = "SELECT * FROM doc where department='ENT'";
            $result = $conn->query($sql);
            $total=mysqli_num_rows($result);
            ?>
            <table border="5px"> 
                <th> Sno </th> 
                <th> Name </th> 
                <th> Experience </th> 
                <th> Gender </th> 
                <th> Price </th>
                <th> Availability </th>
                <th> Details </th>
                <th> Provide Feedback </th>
                <th> Feedbacks </th>  
                <th> Book </th>    
            </tr> 
            <?php while($rows=$result->fetch_assoc()) 
            { 
            ?> 
            <tr> <td><?php echo $rows["sno"]; ?></td> 
            <td><?php echo $rows['NAME']; ?></td>  
            <td><?php echo $rows['experience']; ?></td> 
            <td><?php echo $rows['gender']; ?></td> 
            <td><?php echo $rows['price']; ?></td>
            <td><?php echo $rows['availability']; ?></td>  
            <td>
            <?php
            $description = $rows['Description'];
            $imagePath = "uploads/{$rows['photo']}";
            echo "<button type='button' class='details-button' onclick='showDetails(\"{$description}\", \"{$imagePath}\")'>Details</button>";
            ?>
            </td>
            <td><?php echo "<button type='button' class='details-button' onclick='giveFeedback(\"{$rows['sno']}\",\"{$rows['NAME']}\")'>Provide Feedback</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='openFeedbackModal(\"{$rows['NAME']}\")'>Feedbacks</button>";?></td>
            <td><?php echo "<button type='button' class='details-button' onclick='createAppointmentForm(\"{$rows['NAME']}\", \"{$rows['sno']}\", \"{$_SESSION['user_name']}\", \"{$_SESSION['user_id']}\", \"{$rows['department']}\")'>Book</button>";?></td>
		        </tr>
            <?php 
            } 
      }
    ?>
   <div id="appointmentFormContainer"></div>
   <script>
    var currentForm = null;
    function createAppointmentForm(doctorName, sno,user_name,user_id,dp) {
        removePreviousForm();
    var form = document.createElement('form');
    form.className = 'appointmentForm';
    var userNameInput = document.createElement('input');
    userNameInput.type = 'hidden';
    userNameInput.name = 'user_name';
    userNameInput.value = user_name;
    var userIdInput = document.createElement('input');
    userIdInput.type = 'hidden';
    userIdInput.name = 'user_id';
    userIdInput.value = user_id;
    var doctorId = document.createElement('input');
    doctorId.type = 'hidden';
    doctorId.name = 'doctor_id';
    doctorId.value = sno;
    var departmentInput = document.createElement('input');
        departmentInput.type = 'hidden';
        departmentInput.name = 'department';
        departmentInput.value = dp;
        form.appendChild(userNameInput);
        form.appendChild(userIdInput);
        form.appendChild(doctorId);
        form.appendChild(departmentInput);
        var doctorInput = document.createElement('input');
        doctorInput.type = 'text';
        doctorInput.name = 'doctor';
        doctorInput.value = doctorName;
        doctorInput.readOnly = true;
        var timeSelect = document.createElement('select');
        timeSelect.name = 'timeSlot';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_timeslots.php?doctorId=' + sno, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var timeSlots = JSON.parse(xhr.responseText);
                for (var j = 0; j < timeSlots.length; j++) {
                    var option = document.createElement('option');
                    option.value = timeSlots[j];
                    option.text = timeSlots[j];
                    timeSelect.appendChild(option);
                }
                fetchAvailability(sno, timeSelect.value);
            }
        };
        xhr.send();
        var dateInput = document.createElement('input');
        dateInput.type = 'date';
        dateInput.name = 'date';
        timeSelect.addEventListener('change', function() {
            fetchAvailability(sno, timeSelect.value);
        });
        function fetchAvailability(sno, selectedTimeSlot) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_date.php?sno=' + sno + '&inter=' + selectedTimeSlot, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var availabilityData = JSON.parse(xhr.responseText);
                    var startDate = availabilityData.start_date;
                    var endDate = availabilityData.end_date;
                    dateInput.min = startDate;
                    dateInput.max = endDate;
                }
            };
            xhr.send();
        }
        var submitButton = document.createElement('input');
        submitButton.type = 'submit';
        submitButton.value = 'Book Appointment';
        form.appendChild(document.createTextNode('Doctor: '));
        form.appendChild(doctorInput);
        form.appendChild(document.createElement('br'));
        form.appendChild(document.createTextNode('Time Slot: '));
        form.appendChild(timeSelect);
        form.appendChild(document.createElement('br'));
        form.appendChild(document.createTextNode('Date: '));
        form.appendChild(dateInput);
        form.appendChild(document.createElement('br'));
        form.appendChild(submitButton);
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = {
                doctor: doctorName,
                timeSlot: timeSelect.value,
                date: dateInput.value,
                user_name: userNameInput.value ,
                user_id: userIdInput.value,
                doctor_id: doctorId.value,
                department: departmentInput.value

            };
            removePreviousForm();
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert-booking.php', true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    alert(response);
                    console.log(response);
                }
            };
            xhr.send(JSON.stringify(formData));
        });
        currentForm = form;
        var container = document.getElementById('appointmentFormContainer');
        container.appendChild(form);
    }
    function removePreviousForm() {
        if (currentForm) {
            var container = document.getElementById('appointmentFormContainer');
            container.removeChild(currentForm);
            currentForm = null;
        }
    }
</script>
<style>
  .detailscard {
    position: absolute;
    top:425px;
    right: 200px;
    width: 400px;
    height:250px;
    background-color: #f2f2f2;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 10px;
    transition: transform 0.5s;
    transform: translateX(100%);
    display: flex;
    align-items: center;
  }
  .detailscard .description {
    flex: 1;
    padding-left: 10px;
  }

  .detailscard.open {
    transform: translateX(0);
  }
  .detailscard img {
    max-width: 50%;
    height: auto;
    object-fit: contain;
  }
</style>
<div id="cardContainer"></div>
<script>
  function showDetails(details, imagePath) {
    var existingCard = document.querySelector('.detailscard');
    if (existingCard) {
      existingCard.remove();
    }
    var card = document.createElement('div');
    card.className = 'detailscard';
    var pictureElement = document.createElement('img');
    pictureElement.src = imagePath;
    pictureElement.alt = 'Picture';
    var descriptionDiv = document.createElement('div');
    descriptionDiv.className = 'description';
    var detailsParagraph = document.createElement('p');
    detailsParagraph.textContent = details;
    card.appendChild(pictureElement);
    descriptionDiv.appendChild(detailsParagraph);
    card.appendChild(descriptionDiv);
    var container = document.getElementById('cardContainer');
    if (container) {
      container.appendChild(card);
    } else {
      document.body.appendChild(card);
    }
    setTimeout(function() {
      card.classList.add('open');
    }, 0);
  }
</script>
<script>
  function openFeedbackModal(doctorName) {
    var modal = document.getElementById('feedbackModal');
    var doctorNameSpan = document.getElementById('doctorName');
    var backdrop = document.getElementById('feedbackBackdrop');
    doctorNameSpan.textContent = doctorName;
    modal.style.display = 'block';
    backdrop.style.display = 'block';
    var feedbackContent = document.getElementById('feedbackContent');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var feedbackData = xhr.responseText;
        var feedbackArray = feedbackData.split('\n');
        feedbackContent.innerHTML = '';
        feedbackArray.forEach(feedbackEntry => {
          var feedbackParagraph = document.createElement('p');
          feedbackParagraph.textContent = feedbackEntry;
          feedbackParagraph.textContent = '"' + feedbackEntry + '"';
          feedbackContent.appendChild(feedbackParagraph);
        });
      }
    };
    xhr.open('GET', 'get_feedback.php?doctor=' + encodeURIComponent(doctorName), true);
    xhr.send();
  }
  function closeFeedbackModal() {
    var modal = document.getElementById('feedbackModal');
    var backdrop = document.getElementById('feedbackBackdrop');
    modal.style.display = 'none';
    backdrop.style.display = 'none';
  }
</script>

<script>
    function giveFeedback(doctorID, doctorName) {
      window.location.href = `feedback.php?doctorID=${doctorID}&doctorName=${encodeURIComponent(doctorName)}`;
    }
  </script>
</body>
</html>







