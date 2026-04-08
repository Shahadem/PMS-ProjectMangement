<!DOCTYPE html>
<html>
<head>
<style>
    * {
        box-sizing: border-box;
    }
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        color: white;
        margin-bottom: 10px;
        border-radius: 8px;
        text-align: center;
        transition: width 0.3s ease;
    }
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
        margin-right: 5px;
        border-radius: 4px;
    }
    .btn:hover {
        background-color: #ddd;
    }
    .btn.active {
        background-color: #666;
        color: white;
    }
</style>
</head>
<body>
    <h1>List Grid View Example</h1>
    <h2>Click the buttons to switch between views</h2>
    
    <div id="btnContainer">
        <button class="btn" onclick="listView()">List</button>
        <button class="btn active" onclick="gridView()">Grid</button>
    </div>
    <br>
    
    <div class="row">
        <div class="column" style="background-color: #9a09ad;">
            <h2>Item 1</h2>
            <p>Content for first item</p>
        </div>
        <div class="column" style="background-color: #7123d8;">
            <h2>Item 2</h2>
            <p>Content for second item</p>
        </div>
    </div>
    
    <div class="row">
        <div class="column" style="background-color: #138f55;">
            <h2>Item 3</h2>
            <p>Content for third item</p>
        </div>
        <div class="column" style="background-color: #cf451b;">
            <h2>Item 4</h2>
            <p>Content for fourth item</p>
        </div>
    </div>

    <script>
        var elements = document.querySelectorAll(".column");
        
        function listView() {
            Array.from(elements).forEach(item => {
                item.style.width = "100%";
            });
            updateActiveButton(0);
        }
        
        function gridView() {
            Array.from(elements).forEach(item => {
                item.style.width = "50%";
            });
            updateActiveButton(1);
        }
        
        function updateActiveButton(activeIndex) {
            Array.from(document.querySelectorAll(".btn")).forEach((item, index) => {
                if (index === activeIndex) {
                    item.classList.add("active");
                } else {
                    item.classList.remove("active");
                }
            });
        }
    </script>
</body>
</html>