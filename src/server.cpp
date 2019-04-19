#include <iostream>
#include <stdio.h>
#include <fstream>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <pthread.h>
#include "proto.h"
#include "server.h"

using namespace std;
// Global variables
int server_sockfd = 0, client_sockfd = 0;
ClientList *root, *now;
void substring(char s[], char sub[], int p, int l) {
   int c = 0;
   
   while (c < l) {
      sub[c] = s[p+c-1];
      c++;
   }
   sub[c] = '\0';
}
void WriteToFile(char file[],char mess[]) {
	std::ofstream outfile;
   	outfile.open(file,std::ios_base::app);
   	outfile << mess <<"\n";
}
void WriteToFileNoAppend(char file[],char mess[]) {
	std::ofstream outfile;
   	outfile.open(file,std::ios_base::in);
   	outfile << mess <<"\n";
}
int powInt(int x, int y)
{
    for (int i = 0; i < y; i++)
    {
        x *= 10;
    }
    return x;
}
int parseInt(char* chars)
{
    int sum = 0;
    int len = strlen(chars);
    for (int x = 0; x < len; x++)
    {
        int n = chars[len - (x + 1)] - '0';
        sum = sum + powInt(n, x);
    }
    return sum;
}

void printList(){
	cout<<"List of client!";
	ClientList *p = root;
	while(p != NULL){
		cout<<p->ip<<endl;
		cout<<p->roomPort<<endl;
		cout<<p->name<<endl;
		cout<<p->role<<endl;
		cout<<p->isBan<<endl;
		cout<<"----------"<<endl;
		p=p->link;
	}
	
}
void str_trim_lf (char* arr, int length) {
    int i;
    for (i = 0; i < length; i++) {
        if (arr[i] == '\n') {
            arr[i] = '\0';
            break;
        }
    }
}
void catch_ctrl_c_and_exit(int sig) {
    ClientList *tmp;
    while (root != NULL) {
        printf("\nClose socketfd: %d\n", root->data);
        close(root->data); // close all socket include server_sockfd
        tmp = root;
        root = root->link;
        free(tmp);
    }
    printf("Bye\n");
    exit(EXIT_SUCCESS);
}

void send_to_all_clients(ClientList *np, char tmp_buffer[]) {
    ClientList *tmp = root->link;
    while (tmp != NULL) {
        if (np->data != tmp->data) { // all clients except itself.
            printf("Send to sockfd %d: \"%s\" \n", tmp->data, tmp_buffer);
            send(tmp->data, tmp_buffer, LENGTH_SEND, 0);
        }
        tmp = tmp->link;
    }

}
void send_to_all_clients_room(ClientList *np, char tmp_buffer[],int roomPort) {
    ClientList *tmp = root->link;
    while (tmp != NULL) {
        if (np->data != tmp->data && tmp->roomPort == roomPort) { // all clients except itself.
            printf("Send to sockfd %d: \"%s\" \n", tmp->data, tmp_buffer);
            send(tmp->data, tmp_buffer, LENGTH_SEND, 0);
        }
        tmp = tmp->link;
    }
	strcat(tmp_buffer,"\n");
	char file[50] = {};
	sprintf(file,"%d",roomPort);
	strcat(file,"_chatlog.txt");
	WriteToFile(file,tmp_buffer);
}
int checkExistRoom(int roomPort){
	cout<<"RoomPort:check:"<<roomPort;
	ClientList *tmp = root->link;
	int i = 0;
    while (tmp != NULL) {
        if (tmp->roomPort==roomPort) {
            i=1;
        }
        tmp = tmp->link;
    }
	return i;
}
void* client_handler(void* p_client) {
    int leave_flag = 0;
    char nickname[LENGTH_NAME] = {};
    char recv_buffer[LENGTH_MSG] = {};
    char send_buffer[LENGTH_SEND] = {};
	char chRoomPort[20] = {};
	int roomPort = 0;
    ClientList *np = (ClientList *)p_client;

    // Naming
    if (recv(np->data, nickname, LENGTH_NAME, 0) <= 0 || strlen(nickname) < 2 || strlen(nickname) >= LENGTH_NAME-1) {
        printf("%s didn't input name.\n", np->ip);
        leave_flag = 1;
    } else {
        strncpy(np->name, nickname, LENGTH_NAME);
        printf("%s(%s)(%d) join the chatroom.\n", np->name, np->ip, np->data);
        
    }
	// Check Room Port
	if (recv(np->data, chRoomPort, 20, 0) <= 0) {
        printf("%s didn't input room id.\n", np->ip);
        leave_flag = 1;
    } else {
		
		if(strcmp(chRoomPort, "") == 0){
			strcpy(np->role, "admin");
			roomPort = np->roomPort;
		}
		else{
			roomPort = parseInt(chRoomPort);
			int check = checkExistRoom(roomPort);
			if(check==1){
				strcpy(np->role, "user");
				np->roomPort = roomPort;
				sprintf(send_buffer, "%s(%s) join the chatroom.", np->name, np->ip);
				send_to_all_clients_room(np, send_buffer,roomPort);
				char send_buffer[LENGTH_SEND] = {};
				sprintf(send_buffer, "you joined the room id: %d", roomPort);
				send(np->data,send_buffer, LENGTH_SEND, 0);
				char file[200] = {};
				sprintf(file,"%d",roomPort);
				strcat(file,"_chatlog.txt");
				ifstream myReadFile;
				myReadFile.open(file);
				char output[100];
				if (myReadFile.is_open()) {
					char send_buffer[LENGTH_SEND] = {};
					while (myReadFile >> output) {
						strcat(send_buffer,output);
						strcat(send_buffer," ");
					 }
					 send(np->data, send_buffer, LENGTH_SEND, 0);
				}
			}
			else{
				char send_buffer[LENGTH_SEND] = {};
				sprintf(send_buffer, "Room %s not exist! Ctrl C to exit check %d", chRoomPort,check);
				send(np->data,send_buffer, LENGTH_SEND, 0);
				leave_flag = 1;
			}
			
			
		}
    }
    // Conversation
    while (1) {
        if (leave_flag) {
            break;
        }
        int receive = recv(np->data, recv_buffer, LENGTH_MSG, 0);
        char set_info[7] = {};
		char file[200] = {};
		sprintf(file,"%d",roomPort);
		strcat(file,"_info.txt");
		if (receive == 0 || strcmp(recv_buffer, "exit") == 0) {
            printf("%s(%s)(%d) leave the chatroom.\n", np->name, np->ip, np->data);
            sprintf(send_buffer, "%s(%s) leave the chatroom.", np->name, np->ip);
            leave_flag = 1;
        } 
		else if (strcmp(recv_buffer, "report") == 0){
			if(strcmp(np->role, "admin")==0 || strcmp(np->role, "mod")==0){
				ClientList *tmp = root->link;
				while (tmp != NULL) {
					if (tmp->roomPort == roomPort) {
						char send_buffer[LENGTH_SEND] = {};
						sprintf(send_buffer, "Name:%s, IP:%s, ID:%d, Role:%s, Ban:%d", tmp->name, tmp->ip,tmp->id,tmp->role,tmp->isBan);
						send(np->data, send_buffer, LENGTH_SEND, 0);
					}
					tmp = tmp->link;
				}
			}
			else{
				char send_buffer[LENGTH_SEND] = {};
				sprintf(send_buffer, "Permission denied");
				send(np->data, send_buffer, LENGTH_SEND, 0);
			}
		}
		else if(strcmp(recv_buffer, "info") == 0){
			ifstream myReadFile;
			myReadFile.open(file);
			char output[100];
			if (myReadFile.is_open()) {
				char send_buffer[LENGTH_SEND] = {};
				while (myReadFile >> output) {
					strcat(send_buffer,output);
					strcat(send_buffer," ");
				 }
				 send(np->data, send_buffer, LENGTH_SEND, 0);
			}
		}
		else if(strcmp(recv_buffer, "setinfo") == 0){
			if(strcmp(np->role, "admin")==0 ){
				send(np->data, "Enter content", LENGTH_SEND, 0);
				char content[200] = {};
				char recv_buffer[LENGTH_MSG] = {};
				recv(np->data, recv_buffer, LENGTH_MSG, 0);
				strcat(content,"Room info: ");
				strcat(content,recv_buffer);
				WriteToFileNoAppend(file,content);
			}
			else{
				char send_buffer[LENGTH_SEND] = {};
				sprintf(send_buffer, "Permission denied");
				send(np->data, send_buffer, LENGTH_SEND, 0);
			} 
		}
		else if(strcmp(recv_buffer, "nickname") == 0){
			send(np->data, np->name, LENGTH_SEND, 0);
		}
		else if(strcmp(recv_buffer, "setnickname") == 0){
			send(np->data, "Enter your new nickname", LENGTH_SEND, 0);
			char recv_buffer[LENGTH_MSG] = {};
			recv(np->data, recv_buffer, LENGTH_MSG, 0);
			strncpy(np->name, recv_buffer, 20);
			send(np->data, "Your nickname has been changed", LENGTH_SEND, 0);
		}
		else if(strcmp(recv_buffer, "mods") == 0){
			ClientList *tmp = root->link;
			while (tmp != NULL) {
				if (tmp->roomPort == roomPort) {
					if(strcmp(tmp->role, "admin")==0 || strcmp(tmp->role, "mod")==0 ){
						char send_buffer[LENGTH_SEND] = {};
						sprintf(send_buffer, "Name:%s,ID:%d, Role:%s", tmp->name,tmp->id,tmp->role);
						send(np->data, send_buffer, LENGTH_SEND, 0);
					}
				}
				tmp = tmp->link;
			}
		}
		else if(strcmp(recv_buffer, "mod") == 0){
			send(np->data, "Enter user's id:", LENGTH_SEND, 0);
			char recv_buffer[LENGTH_MSG] = {};
			recv(np->data, recv_buffer, LENGTH_MSG, 0);
			int id = parseInt(recv_buffer);
			ClientList *tmp = root->link;
			while (tmp != NULL) {
				if (tmp->id == id) {
					strncpy(tmp->role, "mod", 5);
				}
				tmp = tmp->link;
			}
			send(np->data, "Mod has been add", LENGTH_SEND, 0);
		}
		else if(strcmp(recv_buffer, "ban") == 0){
			send(np->data, "Enter user's id:", LENGTH_SEND, 0);
			char recv_buffer[LENGTH_MSG] = {};
			recv(np->data, recv_buffer, LENGTH_MSG, 0);
			int id = parseInt(recv_buffer);
			ClientList *tmp = root->link;
			while (tmp != NULL) {
				if (tmp->id == id) {
					tmp->isBan = 1;
				}
				tmp = tmp->link;
			}
			send(np->data, "Mod has been add", LENGTH_SEND, 0);
		}
		else if(strcmp(recv_buffer, "unban") == 0){
			send(np->data, "Enter user's id:", LENGTH_SEND, 0);
			char recv_buffer[LENGTH_MSG] = {};
			recv(np->data, recv_buffer, LENGTH_MSG, 0);
			int id = parseInt(recv_buffer);
			ClientList *tmp = root->link;
			while (tmp != NULL) {
				if (tmp->id == id) {
					tmp->isBan = 0;
				}
				tmp = tmp->link;
			}
			send(np->data, "Mod has been add", LENGTH_SEND, 0);
		}
		else if(strcmp(recv_buffer, "private") == 0){
			send(np->data, "Enter user's id:", LENGTH_SEND, 0);
			char user_id[LENGTH_MSG] = {};
			recv(np->data, user_id, LENGTH_MSG, 0);
			send(np->data, "Message:", LENGTH_SEND, 0);
			char recv_buffer[LENGTH_MSG] = {};
			recv(np->data, recv_buffer, LENGTH_MSG, 0);
			int id = parseInt(user_id);
			ClientList *tmp = root->link;
			while (tmp != NULL) {
				if (tmp->id == id) {
					send(tmp->data, recv_buffer, LENGTH_SEND, 0);
				}
				tmp = tmp->link;
			}
			send(np->data, "Message has been sent", LENGTH_SEND, 0);
		}
		else if(receive < 0) {
            printf("Fatal Error: -1\n");
            leave_flag = 1;
        }
		else{
            if (strlen(recv_buffer) == 0) {
                continue;
            }
            sprintf(send_buffer, "%s：%s", np->name, recv_buffer);
			send_to_all_clients_room(np, send_buffer,np->roomPort);
        } 
    }

    // Remove Node
    close(np->data);
    if (np == now) { // remove an edge node
        now = np->prev;
        now->link = NULL;
    } else { // remove a middle node
        np->prev->link = np->link;
        np->link->prev = np->prev;
    }
    free(np);
}
void create_connect(){
    signal(SIGINT, catch_ctrl_c_and_exit);

    // Create socket
    server_sockfd = socket(AF_INET , SOCK_STREAM , 0);
    if (server_sockfd == -1) {
        printf("Fail to create a socket.");
        exit(EXIT_FAILURE);
    }

    // Socket information
    struct sockaddr_in server_info, client_info;
    int s_addrlen = sizeof(server_info);
    int c_addrlen = sizeof(client_info);
    memset(&server_info, 0, s_addrlen);
    memset(&client_info, 0, c_addrlen);
    server_info.sin_family = PF_INET;
    server_info.sin_addr.s_addr = INADDR_ANY;
    server_info.sin_port = htons(8888);

    // Bind and Listen
    bind(server_sockfd, (struct sockaddr *)&server_info, s_addrlen);
    listen(server_sockfd, 5);

    // Print Server IP
    getsockname(server_sockfd, (struct sockaddr*) &server_info, (socklen_t*) &s_addrlen);
    printf("Start Server on: %s:%d\n", inet_ntoa(server_info.sin_addr), ntohs(server_info.sin_port));
    // Initial linked list for clients
    root = newNode(server_sockfd, inet_ntoa(server_info.sin_addr));
    now = root;
		
		
    while (1) {
        client_sockfd = accept(server_sockfd, (struct sockaddr*) &client_info, (socklen_t*) &c_addrlen);

        // Print Client IP
        getpeername(client_sockfd, (struct sockaddr*) &client_info, (socklen_t*) &c_addrlen);
        printf("Client %s:%d come in.\n", inet_ntoa(client_info.sin_addr), ntohs(client_info.sin_port));
		
        // Append linked list for clients
        ClientList *c = newNode(client_sockfd, inet_ntoa(client_info.sin_addr));
		c->roomPort = ntohs(client_info.sin_port);
		c->id = ntohs(client_info.sin_port);
        c->prev = now;
        now->link = c;
        now = c;
		
        pthread_t id;
        if (pthread_create(&id, NULL,client_handler, c) != 0) {
            perror("Create pthread error!\n");
            exit(EXIT_FAILURE);
        }	
    }
}
int main()
{
	create_connect();
    return 0;
}