import { createServer } from "http";
import { Server } from "socket.io";
import Redis from "ioredis";

var redis = new Redis({
    port: 6379,
    host: "redis",
});

redis.subscribe('parser');

redis.on('message', (channel, message) => {
    io.emit('parser', JSON.parse(message));
});

const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "http://backend.local",
    credentials: true
  }
});

io.on('connection', () => {
    console.log(process.env.SOCKET_PORT)
})

httpServer.listen(process.env.SOCKET_PORT);

