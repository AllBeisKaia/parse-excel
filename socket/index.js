import { createServer } from "http";
import { Server } from "socket.io";
import Redis from "ioredis";

var redis = new Redis({
    port: 6379,
    host: "redis",
});

redis.psubscribe('*:parser');

redis.on('pmessage', (pattern, channel, message) => {
    let ch = channel.split(':')
    io.emit(ch[0] + ':parser', JSON.parse(message));
});

const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: process.env.APP_URL,
    credentials: true
  }
});

io.on('connection', () => {
    console.log('Connected')
})

httpServer.listen(process.env.SOCKET_PORT);

