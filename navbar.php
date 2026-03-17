<style>
    /* Reset some basic styles */
    body, ul, li {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navbar Container */
    #navbar-container {
        width: 100%;
        background-color: #333;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        padding: 10px 20px;
        position: relative;
    }

    /* Logo Section */
    #navbar-logo {
        width: 10%;
        display: flex;
        align-items: center;
    }

    #navbar-logo img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
    }

    /* Navigation Links */
    #navbar-links {
        list-style-type: none;
        display: flex;
        gap: 20px;
        font-size: 17px;
        font-family: 'Poppins', sans-serif;
        text-transform: capitalize;
    }

    #navbar-links li a {
        text-decoration: none;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    #navbar-links li a:hover {
        background-color: #555;
        color: lightslategray;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #navbar-container {
            flex-direction: column;
            padding: 10px;
        }

        #navbar-logo {
            width: 100%;
            justify-content: center;
            margin-bottom: 10px;
        }

        #navbar-links {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        #navbar-links li a {
            padding: 10px 20px;
        }
    }
</style>

<nav id="navbar-container">
    <div id="navbar-logo">
        <img src="shoes store.png" alt="Logo" width="130" height="130" style="border-radius: 50%;">
    </div>
    <div style="width: 80%; display: flex; justify-content: center;">
        <ul id="navbar-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="about us.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login_form.php">Login</a></li>
            <li><a href="register_form.php">Register</a></li>
        </ul>
    </div>
</nav>
