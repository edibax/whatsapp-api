const express = require('express');
const app = express();
const whatsapp = require('./src/whatsapp');

const PORT = process.env.PORT || 3000;

app.use(express.json());

app.post('/send-message', async (req, res) => {
    const { number, message } = req.body;
    try {
        const response = await whatsapp.sendMessage(number, message);
        res.status(200).json({ success: true, response });
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
});

app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
