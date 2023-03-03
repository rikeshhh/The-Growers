<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About US</title>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Allura|Josefin+Sans');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #E1D9D1;
        font-family: 'Josefin Sans', sans-serif;
    }

    .wrapper {
        margin-top: 10%;
    }

    .wrapper h1 {
        font-family: 'Allura', cursive;
        font-size: 52px;
        margin-bottom: 60px;
        text-align: center;
    }

    .team {
        display: flex;
        justify-content: center;
        width: auto;
        text-align: center;
        flex-wrap: wrap;
    }

    .team .team_member {
        background: #fff;
        margin: 5px;
        margin-bottom: 50px;
        width: 300px;
        padding: 20px;
        line-height: 20px;
        color: #8e8b8b;
        position: relative;
    }

    .team .team_member h3 {
        color: #81c644;
        font-size: 26px;
        margin-top: 50px;
    }

    .team .team_member p.role {
        color: #ccc;
        margin: 12px 0;
        font-size: 12px;
        text-transform: uppercase;
    }

    .team .team_member .team_img {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #fff;
    }

    .team .team_member .team_img img {
        width: 100px;
        height: 100px;
        padding: 5px;
        border-radius: 50%;
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <h1>About Us</h1>
        <div class="team">
            <div class="team_member">
                <div class="team_img">
                    <img src="./aboutusimg/lenish.jpg" alt="Team_image">
                </div>
                <h3>Lenish Magar</h3>
                <p class="role">Backend Developer</p>
                <p>Studies at kantipur city college intrested in backend developement. Flexible in HTML, CSS, Java and
                    PHP and mysql. </p>
                <br>
                <p>For more you can check <br>
                    <a href="https://github.com/R4V3NSH4D0W" target=" "> Github profile</a>
                </p>
            </div>
            <div class="team_member">
                <div class="team_img">
                    <img src="./aboutusimg/manish.jpg" alt="Team_image">
                </div>
                <h3>Manish Shrestha</h3>
                <p class="role">Frontend developer</p>
                <p>Studies at kantipur city college. intrested in Front end developement. Flexible in HTML, CSS and Java
                </p>
                <br>
                <p>For more you can check <br>
                    <a href="https://github.com/itsmems" target=" "> Github profile</a>
                </p>

            </div>
            <div class="team_member">
                <div class="team_img">
                    <img src="./aboutusimg/puran.jpg" alt="Team_image">
                </div>
                <h3>Puran Gupta</h3>
                <p class="role">UI developer</p>
                <p>Studies at Kantipur City college. intrested in UI/UX developement. Flexible in HTML and Figma.</p>
                <br>
                <br>
                <p>For more you can check <br>
                    <a href="https://github.com" target=" "> Github profile</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>