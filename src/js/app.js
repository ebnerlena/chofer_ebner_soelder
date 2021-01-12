window.addEventListener('scroll', function() {

    if (window.pageYOffset > 100) {
        document.getElementById('topnav').classList.add("fixed");
    } else {
        document.getElementById('topnav').classList.remove("fixed");
    }
    
  });