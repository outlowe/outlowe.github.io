const express = require('express');
const fs = require('fs');
const app = express();
const PORT = 3000;

app.use(express.json());

// Giriş kayıtlarını tutmak için bir dosya
const logFilePath = 'loginRecords.json';

// Kullanıcı girişini kaydet
app.post('/login', (req, res) => {
    const ip = req.ip;
    const date = new Date().toISOString();

    // Kayıtları oku
    let records = [];
    if (fs.existsSync(logFilePath)) {
        const data = fs.readFileSync(logFilePath);
        records = JSON.parse(data);
    }

    // Kayıtları güncelle
    const existingRecord = records.find(record => record.ip === ip);
    if (existingRecord) {
        existingRecord.loginCount++;
    } else {
        records.push({ ip, date, loginCount: 1 });
    }

    // Güncellenmiş kayıtları yaz
    fs.writeFileSync(logFilePath, JSON.stringify(records, null, 2));
    res.send('Giriş kaydedildi');
});

// Giriş kayıtlarını getir
app.get('/records', (req, res) => {
    if (fs.existsSync(logFilePath)) {
        const data = fs.readFileSync(logFilePath);
        res.json(JSON.parse(data));
    } else {
        res.json([]);
    }
});

app.listen(PORT, () => {
    console.log(`Sunucu ${PORT} portunda çalışıyor`);
});
