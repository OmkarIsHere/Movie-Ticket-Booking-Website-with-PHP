<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
</head>
<style>
    :root {
        --background-color: #212529;
        --main-color: #D72323;
        --primary-color: #EEEEEE;
        --secondary-color: #343a40;
        --grey-color: #d3d3d3;
        --box-shadow: rgba(77, 77, 77, 0.2) 0px 6px 10px 6px;
    }

    html {
        font-size: 1rem;
        margin: 0;
        scroll-behavior: smooth;
    }

    body {
        max-width: 100vw;
        height: auto;
        overflow-x: hidden;
        margin: 0;
        background-color: var(--background-color);
        font-family: 'Lato', serif;
        scroll-behavior: smooth;
    }

    .container {
        position: absolute;
        height: auto;
        width: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2vw;
        z-index: 1;
        top: 70%;
        left: 40%;
    }

    #tagline {
        position: relative;
        font-weight: 500;
        font-size: 1.4rem;
        text-align: initial;
        margin: 0px;

    }

    #homebtn {
        position: relative;
        display: inline-block;
        padding: 0.6rem 1.2rem;
        line-height: 1rem;
        background-color: var(--main-color);
        border: 0.1rem solid var(--main-color);
        color: var(--primary-color);
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        font-style: normal;
        text-transform: capitalize;
        box-shadow: 0px 2px 10px -1px rgb(0 0 0 / 19%);
        transition: all .4s ease-out 0s;
        border-radius: 5px;
    }

    #homebtn:hover {
        background-color: red;
        color: var(--primary-color);
        cursor: pointer;
    }

    @media screen and (max-width: 2260px) {
        .container {
            top: 70%;
            left: 45%;
        }

        #tagline {
            font-size: 1.4rem;
        }

        #homebtn {
            padding: 0.8rem 1.5rem;
            line-height: 1.2rem;
            font-size: 1.2rem;
            font-weight: 600;
        }
    }

    @media screen and (max-width: 768px) {
        .container {
            top: 70%;
            left: 35%;
        }

        #tagline {
            font-size: 1.2rem;
        }

        #homebtn {
            padding: 0.8rem 1.5rem;
            line-height: 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
    }

    @media screen and (max-width: 480px) {
        .container {
            top: 70%;
            left: 30%;
        }

        #tagline {
            font-size: 1rem;
        }

        #homebtn {
            padding: 0.8rem 1.2rem;
            line-height: 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
    }
</style>

<body>
    <img style="position:relative; height:100vh; width:100%; object-fit:cover" src="../img/404error.jpg" alt="Page not found">
    <div class="container">
        <p id="tagline">Back to Home : </p><a href="../index.php" id="homebtn">HOME</a>
    </div>
</body>

</html>