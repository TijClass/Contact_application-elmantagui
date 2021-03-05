<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">    
    <title>Contact Application</title>
</head>

<body>
    <nav class="nav-bar">
        <div class="nav-bar-container">
            <div class="logo-container">
                <img src="public/img/brand.png" alt="Brand logo">
            </div>
            <div class="brand-name-container">
                <h1 class="brand-name">
                    Contact Application
                </h1>
            </div>
            <div class="logout-container">
                <a href="/logout">
                    <button class="logout-btn">SignOut</button>
                </a>
            </div>
        </div>
    </nav>
    <main class="contact-container">
        <h1 class="contact-title text-6xl text-center mt-4	">Contact List</h1>
        <div class="control-container">
            <input class="search-input" type="text" placeholder="Search">
            <button id="addcontact-btn" class="addcontact-btn">Add Contact</button>
        </div>
        <div class="table-container mt-6 mx-4">
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Adress</th>
                        <th>Phone Number</th>
                        <th>Groupe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "./functions/db.php";
                    $query = $con->prepare('SELECT * FROM `contacts`');
                    $query->execute();
                    $contacts = $query->fetchAll(PDO::FETCH_ASSOC);                    
                    foreach($contacts as $contact){ 
                        ?>                        
                        <tr id="tr-<?=$contact["id"]?>">
                            <td><?=$contact["id"]?></td>
                            <td><?=$contact["first_name"]?></td>
                            <td><?=$contact["last_name"]?></td>
                            <td><?=$contact["email"]?></td>
                            <td><?=$contact["address1"]?></td>
                            <td><?=$contact["phone"]?></td>
                            <td><?=$contact["group"]?></td>
                            <td class="action-td"><span class="edit-action">Edit</span> <span><img data-id="<?=$contact["id"]?>" class="close-icon" src="public/img/x.png" alt=""></span></td>
                        </tr>
                    <?php
                    }                                        
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <div id="modal-container" class="modal-container">
        <div class="modal">
            <h1 class="contact-title text-6xl text-center mt-4">Add Contact</h1>
            <div class="modal-form-container  h-5/6 flex flex-col justify-evenly">
                <input type="hidden" name="id">
                <div class="form-items">
                    <label class="text-grey-900" for="">First Name</label>
                    <input class="text-lg" name="firstName" type="text" placeholder="Mike">
                </div>
                <div class="form-items">
                    <label class="text-grey-900" for="">Last Name</label>
                    <input class="text-lg" name="lastName" type="text" placeholder="brody">
                </div>
                <div class="form-items">
                    <label class="text-grey-900" for="">Email</label>
                    <input class="text-lg" name="email" type="text" placeholder="MikeBrody@email.com">
                </div>
                <div class="form-items">
                    <label class="text-grey-900" for="">Adress</label>
                    <input class="text-lg" name="adress" type="text" placeholder="21st,LA">
                </div>
                <div class="form-items">
                    <label class="text-grey-900" for="">Number Phone</label>
                    <input class="text-lg" name="phone" type="text" placeholder="+ (343) 231 545">
                </div>
                <div class="groupe-items">
                    <div class="groupe-item">
                        <input type="radio" name="groupe" id="groupe-familly" checked >
                        <label for="groupe-familly"> Familly</label>
                    </div>
                    <div class="groupe-item">
                        <input type="radio" name="groupe" id="groupe-friend">
                        <label for="groupe-friend"> Friend</label>
                    </div>
                    <div class="groupe-item">
                        <input type="radio" name="groupe" id="groupe-business">
                        <label for="groupe-business"> Business</label>
                    </div>
                </div>
                <!-- <div class="form-items">
                    <label class="text-grey-900" for="">Notes</label>
                    <textarea class="text-lg" rows="5" type="text" placeholder="Write something that make you remember."></textarea>
                </div> -->
                <div class="form-items-btn mt-8">
                    <button class="modal-btn" id="modal-btn">Add</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="public/js/app.js"></script>
</body>

</html>