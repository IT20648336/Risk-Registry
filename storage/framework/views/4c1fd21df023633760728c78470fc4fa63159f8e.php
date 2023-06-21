<!DOCTYPE html>
<html lang="en" >
<head>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap" rel="stylesheet">

<style>
body {
    --header-height: 50px;

    margin: var(--header-height) 0 0 0;
    font-family: 'Muli', sans-serif;
}

.preload * {
    transition: none !important;
}

.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: var(--header-height);
    background: #333333;
    display: flex;
}

.header__button {
    width: var(--header-height);
    flex-shrink: 0;
    background: none;
    outline: none;
    border: none;
    color: #ffffff;
    cursor: pointer;
}

.nav__links {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 2;
    height: 100vh;
    width: 250px;
    background: #ffffff;
    transform: translateX(-250px);
    transition: transform 0.3s;
}

.nav--open .nav__links {
    transform: translateX(0);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.nav__link {
    display: flex;
    align-items: center;
    color: #666666;
    font-weight: bold;
    font-size: 14px;
    text-decoration: none;
    padding: 12px 15px;
    background: transform 0.2s;
}

.nav__link > i {
    margin-right: 15px;
}

.nav__link--active {
    color: #009578;
}

.nav__link--active,
.nav__link:hover {
    background: #eeeeee;
}

.nav__overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(2px);
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s;
}

.nav--open .nav__overlay {
    visibility: visible;
    opacity: 1;
}
</style>

</head>

<body class="preload">
    <header class="header">
        <button class="header__button" id="btnNav" type="button">
            <i class="material-icons">menu</i>
        </button>
    </header>
    <nav class="nav">
        <div class="nav__links">
            <a href="#" class="nav__link">
                <i class="material-icons">dashboard</i>
                Dashboard
            </a>
            <a class="nav__link nav__link--active" href="#">
                <i class="material-icons">Home</i>
                Projects
            </a>
            <a class="nav__link" href="#">
                <i class="material-icons">lock</i>
                Security
            </a>
            <a class="nav__link" href="#">
                <i class="material-icons">history</i>
                History
            </a>
            <a class="nav__link" href="#">
                <i class="material-icons">person</i>
                Profile
            </a>
        </div>
        <div class="nav__overlay"></div>
    </nav>
    
    <main>
        Hi my name is Dom!
    </main> 
</body>

</body>
</html><?php /**PATH /data/RiskRegistry/resources/views/portal.blade.php ENDPATH**/ ?>