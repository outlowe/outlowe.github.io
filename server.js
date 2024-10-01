const WebSocket = require('ws');
const server = new WebSocket.Server({ port: 3000 });

let viewerCount = 0;

server.on('connection', (socket) => {
    viewerCount++;
    broadcastViewerCount();

    socket.on('close', () => {
        viewerCount--;
        broadcastViewerCount();
    });
});

function broadcastViewerCount() {
    server.clients.forEach((client) => {
        if (client.readyState === WebSocket.OPEN) {
            client.send(viewerCount.toString());
        }
    });
}

console.log('WebSocket sunucusu 3000 portunda çalışıyor.');
