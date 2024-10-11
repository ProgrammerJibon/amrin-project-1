<?php
require_once "./config.php";
$categories = mysqli_query($connect, "SELECT * FROM book_cats");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BOOK</title>
    <!-- Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-icons/1.0.0/line-icons.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" />

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="main">
        <!-- HEADER -->
        <div id="header">
            <div id="logo">
                <img src="https://st.depositphotos.com/1157537/1910/v/450/depositphotos_19102315-stock-illustration-ebook-tag-button-red.jpg">
            </div>
            <div class="texts"><a href="#page1">Home</a></div>
            <div class="texts"><a href="#about">Services</a></div>
            <div class="texts" style="display: flex; position: relative;">
                <a href="#page2">Types</a>
                <i class="ri-arrow-down-s-line"></i>
                
                <!-- Dropdown menu for categories -->
                <div class="dropdown">
                    <ul>
                        <?php
                        foreach($categories as $category) {
                            echo '<li><a href="/view_category.php?id=' . $category['id'] . '">' . $category['cat_name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>


            <div id="contactDetails">
                <p style="text-align: center;">
                    <div class="texts"><a href="#contact">Contact Us</a></div>
                </p>
            </div>
            <div class="icon"><i class="ri-search-line"></i></div>
            <?php if(isset($user_info['id'])){ ?>
                <div id="login"><a href="<?php echo isset($user_info['role']) && $user_info['role']=="ADMIN"?"/admin.php":"" ?>"><i class="ri-user-3-fill"></i> <?php echo $user_info['full_name']; ?></a></div>
                <a href="/logout.php" id="try">Logout</a>
            <?php }else{ ?>
                <div id="login"><a href="#page3"><i class="ri-user-3-fill"></i> Login</a></div>
                <a href="/signup.php" id="try">Try For Free</a>
            <?php } ?>
        </div>

        <!-- PAGE-1 -->
        <div id="page1">
            <!-- <div id="strip">
                <p>THIS IS BEST E-BOOK PLATFORM. <u>Read</u></p>
            </div> -->
            <div id="content">
                <div id="box1">
                    <h1>Discover the exquisite collection of happiness</h1>
                    <p>Are you a fervent reader? If so, this place is for you! Discover the enormous collection of e-books designed for the bookworms!</p>
                    <!-- <div id="btns">
                        <div id="btn1">Start Free Trial</div>
                        <div id="btn2">Read Demo</div>
                    </div> -->
                </div>
                <div id="box2">
                    <div id="card1" class="card">
                        <img src="Image pg-1/a1.png" alt="">
                    </div>
                    <div id="card2" class="card">
                        <img src="Image pg-1/a2.avif" alt="">
                    </div>
                    <div id="card3" class="card">
                        <img src="Image pg-1/a3.jpg" alt="">
                    </div>
                    <div id="card4" class="card">
                        <img src="Image pg-1/a4.jpg" alt="">
                    </div>
                </div>
            </div>
            <div id="heading"><h1>Learn more knowledge. Book is a story of knowledge.</h1></div>
        </div>

        <!-- About Page -->
        <div id="about">
            <div class="container" style="max-width: 720px; margin-bottom: 128px; text-align: justify;">
                <div>
                <h2 class="head">About <span>Us</span></h2>
                <div class="content">
                    <p>Welcome to our E-Book platform! We are dedicated to providing a wide range of e-books for avid readers across the globe. Whether you're looking for programming guides, academic materials, or indulging in fiction and non-fiction books, we have something for everyone.</p>
                    <p>Our platform is designed with simplicity and convenience in mind, offering easy access to an extensive collection of digital books. We strive to promote knowledge-sharing and make reading accessible to all through our free trial and demo features.</p>
                    <p>Our team is passionate about creating the best experience for book lovers, ensuring that our platform is user-friendly, informative, and enjoyable.</p>
                    
                    <h3>Our Mission</h3>
                    <p>Our mission is to make learning and reading easier for everyone by providing a seamless and efficient platform that connects readers with the books they love. We believe in the power of knowledge and its ability to inspire and change lives, which is why we're committed to continuously improving our services.</p>

                    <h3>Why Choose Us?</h3>
                    <ul class="services-list">
                        <li><i class="material-symbols-rounded">check_circle</i> Extensive collection of e-books in multiple categories</li>
                        <li><i class="material-symbols-rounded">check_circle</i> User-friendly interface with smooth navigation</li>
                        <li><i class="material-symbols-rounded">check_circle</i> Free trial and demo options available</li>
                        <li><i class="material-symbols-rounded">check_circle</i> Access your favorite books anytime, anywhere</li>
                    </ul>
                </div>
                </div>
            </div>
        </div>

        <?php if(mysqli_num_rows($categories) > 0){ ?>
        <div id="page2">
        <div class="container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <?php foreach($categories as $category) { 
                        // Fetch books for the current category
                        $category_id = $category['id'];
                        $books = mysqli_query($connect, "SELECT * FROM book_items WHERE book_cat_id = '$category_id'");
                        $book_count = mysqli_num_rows($books);
                    ?>
                        <li class="card-item swiper-slide">
                            <a href="/view_category.php?id=<?php echo $category_id; ?>" class="card-link">
                                <img src="<?php echo $category['cover_path']; ?>" alt="Card Image" class="card-image">
                                <p class="badge"><?php echo $category['cat_name']; ?></p>
                                <h2 class="card-title">Available books: </h2>
                                <div>
                                    <?php
                                    $xtwe = 0;
                                    while($book = mysqli_fetch_assoc($books)){
                                        $xtwe++;      
                                        $more  = "";                                  
                                        if($xtwe > 3){ 
                                            echo "and more";   
                                            break;                                        
                                        }else{
                                            echo "<span>$book[book_name]</span>, ";
                                        }
                                        
                                    }
                                    ?>
                                </div>
                                <span style="display: inline-flex; align-items: center;">
                                    <span class="material-symbols-rounded">menu_book</span>
                                    <p style="margin-left: 6px;"><?php echo $book_count; ?></p>
                                    <br>
                                </span>
                                    <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.card-wrapper', {
            loop: true,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                <?php if(mysqli_num_rows($categories) > 1){ ?>
                768: { slidesPerView: 2 },
                <?php }elseif(mysqli_num_rows($categories) > 2){ ?>
                1024: { slidesPerView: 3 },
                <?php } ?>
            }
        });
    </script>
    
    <?php } ?>

        <!-- CONTACT US -->
        <div id="contact" class="main">
            <h2 class="head">Team <span>Members</span></h2>
            <div class="container">
                <div class="box">
                    <img src="Image pg-2/amrin.jpg" width="200px"> 
                    <div class="name_post">
                        <p class="name">Amrin Hossain</p>
                        <p class="deg">Front End Developer</p>
                    </div>
                    <div class="social-icons">
                        <ul>
                            <li><i class="uil uil-facebook-f"></i></li>
                            <li><i class="uil uil-instagram"></i></li>
                            <li><i class="uil uil-twitter-alt"></i></li>
                            <li><i class="uil uil-linkedin-alt"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <img src="Image pg-2/niber.jpg" width="200px"> 
                    <div class="name_post">
                        <p class="name">Naibir</p>
                        <p class="deg">Back End Developer</p>
                    </div>
                    <div class="social-icons">
                        <ul>
                            <li><i class="uil uil-facebook-f"></i></li>
                            <li><i class="uil uil-instagram"></i></li>
                            <li><i class="uil uil-twitter-alt"></i></li>
                            <li><i class="uil uil-linkedin-alt"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!isset($user_info['id'])){ ?>
        <div id="page3">
            <div class="login-container">
                <div class="login-box">
                    <h2>Login</h2>
                    <form action="/login.php" method="post">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="pass" placeholder="Enter your password" required>
                        </div>
                        <div class="input-group">
                            <input type="submit" value="Login">
                        </div>
                        <p class="signup-link">Don't have an account? <a href="/signup.php">Sign up here</a></p>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>


<script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>