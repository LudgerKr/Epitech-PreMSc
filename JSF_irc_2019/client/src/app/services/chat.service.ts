import {Injectable} from '@angular/core';
import * as io from 'socket.io-client';
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';

@Injectable()

export class ChatService {

  isAuth = false;
  user;
  channel;

  private socket = io('http://localhost:3000');

  constructor(private http: HttpClient) { }

  register(values) {
    this.socket.emit('new_user', values);
  }

  connexion(values) {
    // tslint:disable-next-line:max-line-length
      this.socket.emit('user_connect', values);
      var parentThis = this;

      this.socket.on("user_connect", function(data) {
        if (!data.error) {
          parentThis.user = data;
          parentThis.isAuth = true;
        } else {
          //AFFICHER mauvais mot de passe ou login :)
        }
      });
  }

  signOut() {
    this.socket.emit('update_user', {'online': "false", 'token': this.user.token});
    this.isAuth = false;
  }

  getMessages() {
    var channel;
    if (this.channel) {
      channel = "&channel=" + this.channel;
    }

    return this.http.get('http://localhost:3000/api/messages?order=id:DESC&limit=30&' + channel);
  }

  sendMessage(values) {
    if (values.content.charAt(0) === "/") {
      var commands = values.content.slice(1,values.content.length).split(' ');
      //console.log(messages);

      switch (commands[0]) {
        case 'join':
          this.channel = commands[1].charAt(0).toUpperCase() + commands[1].slice(1);
          this.socket.emit('join_channel', {'channelName': this.channel, token: this.user.token});
          break;
        case 'leave':
          if (this.channel) {
            this.socket.emit('leave_channel', {'channelName': this.channel, token: this.user.token});
            console.log('leave channnel' + this.channel);
            this.channel = undefined;
          }
          break;
        case 'bot':
          this.socket.emit('bot_send', {'message': commands.splice(1).join(' '), 'channel': this.channel});
          break;
        case 'edit' :
          if (this.channel && commands[1]) {
            this.socket.emit('edit_channel', {'channelName': this.channel,'newName': commands[1], token: this.user.token});
            this.channel = commands[1];
          }
          break;
        case 'delete' :
          if (this.channel) {
            this.socket.emit('delete_channel', {'channelName': this.channel, token: this.user.token});
            this.channel = undefined;
          }
          break;
        default:
          console.log('command not found');
          break;
      }
    } else {
      this.socket.emit('new_message', {'content':values.content, 'token': this.user.token, 'channel': this.channel});
    }
  }

  newMessageReceived() {
    let observable = new Observable (observer=>{
      this.socket.on('new_message', (data) => {
        data = this.getMessages();
        observer.next(data);
      });
    });

    return observable;
  }

  newUserStatus() {
    let observable = new Observable (observer => {
      this.socket.on('user_new_status', (data) => {
        observer.next({"connect": this.getConnectedUsers(), "disconnect": this.getDisonnectedUsers()});
      });
    })

    return observable;
  }

  getConnectedUsers() {
    var channel;
    if (this.channel) {
      channel = "&channelName=" + this.channel;
    }
    return this.http.get('http://localhost:3000/api/users?online=true&' + channel);
  }

  getDisonnectedUsers() {
    var channel;
    if (this.channel) {
      channel = "&channelName=" + this.channel;
    }
    return this.http.get('http://localhost:3000/api/users?online=false&' + channel);

  }
}
