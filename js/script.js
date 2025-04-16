 function showView(viewType) {
        document.getElementById('cards-view').style.display = 'none';
        document.getElementById('table-view').style.display = 'none';
        document.getElementById(viewType + '-view').style.display = 'block';
    }
