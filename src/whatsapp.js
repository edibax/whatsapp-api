const venom = require('venom-bot');

let client;

venom
    .create(
        'sessionName', // Nome da sessão
        undefined,
        undefined,
        { folderSession: './sessions', headless: false } // Configurações da sessão e desativa o modo headless
    )
    .then((bot) => {
        client = bot;
        console.log('WhatsApp conectado!');
    })
    .catch((error) => {
        console.error('Erro ao conectar ao WhatsApp', error);
    });

// Função para enviar mensagem
async function sendMessage(number, message) {
    if (!client) throw new Error('Cliente WhatsApp não inicializado');
    try {
        return await client.sendText(`${number}@c.us`, message);
    } catch (error) {
        console.error("Erro ao enviar a mensagem:", error);
        throw error;
    }
}

module.exports = { sendMessage };
