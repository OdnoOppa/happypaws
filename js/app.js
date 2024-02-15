//express module zarlah
const express = require('express');
const app = express();

// API endpoint iinhpp route
app.get('/api/data', (req, res) => {
    //amitnii data 
    const data = [
        { type: "муур", sex: "Эр", status: "авах", date: "2023.11.05", image: "../assets/pet-pic/muur1.png", location: "Хан-Уул" },
        { type: "нохой", sex: "Эр", status: "авах", date: "2023.11.10", image: "../assets/pet-pic/nohoi2.png", location: "Баянгол" },
        { type: "муур", sex: "Эм", status: "үрчлэх", date: "2023.11.15", image: "../assets/pet-pic/muur2.png", location: "Сонгинохайрхан" },
        { type: "муур", sex: "Эр", status: "үрчлэх", date: "2023.11.20", image: "../assets/pet-pic/muur3.png", location: "Багануур" },
        { type: "нохой", sex: "Эр", status: "үрчлэх", date: "2023.11.25", image: "../assets/pet-pic/nohoi1.png", location: "Багахангай" },
        { type: "муур", sex: "Эм", status: "авах", date: "2023.11.30", image: "../assets/pet-pic/muur4.png", location: "Баянзүрх" },
        { type: "муур", sex: "Эр", status: "үрчлэх", date: "2023.12.01", image: "../assets/pet-pic/muur5.png", location: "Налайх" },
        { type: "нохой", sex: "Эр", status: "авах", date: "2023.11.05", image: "../assets/pet-pic/nohoi2.png", location: "Чингэлтэй" },
        { type: "муур", sex: "Эм", status: "үрчлэх", date: "2023.11.01", image: "../assets/pet-pic/muur7.png", location: "Сүхбаатар" },

    ];


    // JSON response oor haruulah
    res.json(data);
});

// Express serveree neeh
const port = process.env.PORT || 3000;
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
