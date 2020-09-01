<?php 

 session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["ID"]) ) {
        header("location: login.php");
        exit;
    }
 


include 'includes/layout/header.php';
include 'includes/functions/functions.php'
?>

<style>
      .containerBar {
        overflow: hidden;
        background-color: #333;
      }

      .containerBar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }
    .profile_1 {
        width: 50%;
        /* background: green; */
        float: left;
    }
    .profile_2 {
        width: 20%;
        /* background: green; */
        float: right;
    }
</style>

    <div class="containerBar">
        <br>
        <div class="profile_1">
            <h2>Agenda de :  <?php echo $_SESSION['UserName'];?></h2>
        </div>
        <div class="profile_2">
            <a href="logout.php" style="color: white"><i class="fa fa-fw fa-power-off"></i>log out</a>
        </div>
    </div>

<div class="bgBlue container shadow">
    <form id ="contact" action ="">
        <legend>Add a new contact <span>*All the fields are neccisaire*</span></legend>
        
        <?php include 'includes/layout/form.php'; ?>
        
    </form>
</div>

<div class="bgYellow container shadow contacts" >
    <div class="contactsContainer">
        <h2>Contacts</h2>

        <input type="text" id ="search" class="seeker shadow" placeholder="Search">

        <p class="totalContacts"><span></span> Contacts</p>

        <div class="tableContainer">
            <table id="contactList" class="contactList">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contacts = obtainContacts($_SESSION['ID']);
                        if($contacts->num_rows){ 
                            foreach($contacts as $contact){ ?>
                            <tr> 
                                <td><?php echo $contact['name']; ?></td>
                                <td><?php echo $contact['company'];?></td>
                                <td><?php echo $contact['phone'];?></td>
                                <td><a class="btn-edit btn" href="edit.php?id=<?php echo $contact['id'];?>"><i class="fas fa-edit"></i></a><button class="btn-delete btn"data-id="<?php echo $contact['id'];?>"type ="button"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                            <?php }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/layout/footer.php'; ?>