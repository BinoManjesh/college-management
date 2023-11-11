document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openBtn');
    const popup = document.getElementById('popup');
    const closeBtn = document.getElementById('closeBtn');
  
    openBtn.addEventListener('click', function () {
      popup.style.display = 'block';
    });
  
    closeBtn.addEventListener('click', function () {
      popup.style.display = 'none';
    });
  });