<?php
/*


```<!-- PAGE-2 -->

        <!-- this shows book category with available books in this category -->
        <div id="page2">
            <div class="container swiper">
                <div class="card-wrapper">
                    <ul class="card-list swiper-wrapper">
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="Image pg-2/Programming.jpg" alt="Card Image" class="card-image">
                                <p class="badge">Programming</p>
                                <h2 class="card-title">Available book: </h2>
                                <span style="display: inline-flex; align-items: center;">
                                <span class="material-symbols-rounded">
                                    menu_book 
                                </span>
                                <p style="margin-left: 6px;">4</p> <br>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="Image pg-2/a5.jpg" alt="Card Image" class="card-image">
                                <p class="badge">Academic</p>
                                <h2 class="card-title">Available book: </h2>
                                <span style="display: inline-flex; align-items: center;">
                                <span class="material-symbols-rounded">
                                    menu_book 
                                </span>
                                <p style="margin-left: 6px;">10</p> <br>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="Image pg-2/f.jpg" alt="Card Image" class="card-image">
                                <p class="badge">Fiction</p>
                                <h2 class="card-title">Available book: </h2>
                                <span style="display: inline-flex; align-items: center;">
                                <span class="material-symbols-rounded">
                                    menu_book 
                                </span>
                                <p style="margin-left: 6px;">3</p> <br>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="Image pg-2/nonfiction.jpg" alt="Card Image" class="card-image">
                                <p class="badge">Non-Fiction</p>
                                <h2 class="card-title">Available book: </h2>
                                <span style="display: inline-flex; align-items: center;">
                                <span class="material-symbols-rounded">
                                    menu_book 
                                </span>
                                <p style="margin-left: 6px;">3</p> <br>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                    </ul>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
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
                        768: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 },
                    }
                });
            </script>
        </div>```

tables:
book_items: `book_name`, `book_cover`, `pdf_path`, `book_details`, `book_cat_id`, `time`
book_cats:  `cover_path`, `cat_name`, `time`


now generate pages for admin with common css styles, 
view_users.php
    admin will see the list of users registered here
add_categories.php:
    here, admin will be able to add books categories with the needed field as our table
add_books.php:
    here, admin will be able to add books item with the needed field as our table

and update the html code to show the categories with our tables on database, and show the list of books on category and our design, dont update any style on this view
