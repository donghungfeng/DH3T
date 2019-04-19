#include <fstream>
#include <iostream>
#include <stdio.h>
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
#include "string.h"

using namespace std;
// Global variables
volatile sig_atomic_t flag = 0;
int sockfd = 0;
int roomPort = 0;
char chRoomPort[5] = {};
char nickname[LENGTH_NAME] = {};

void Write(char file[],char mess[]) {
	std::ofstream outfile;
   	outfile.open(file,std::ios_base::app);
   	outfile << mess<<endl;
}
void Read(){
	char file[50] = {};
	sprintf(file,"%d",roomPort);
	strcat(file,"_info.txt");
	string line;
	ifstream myfile (file);
	if (myfile.is_open())
	{
		while ( getline (myfile,line) )
		{
		  cout << line << '\n';
		}
		myfile.close();
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

void str_overwrite_stdout() {
    printf("\r%s", "> ");
    fflush(stdout);
}
void catch_ctrl_c_and_exit(int sig) {
    flag = 1;
}

void* recv_msg_handler(void* a) {
    char receiveMessage[LENGTH_SEND] = {};
    while (1) {
        int receive = recv(sockfd, receiveMessage, LENGTH_SEND, 0);
        if (receive > 0) {
            printf("\r%s\n", receiveMessage);
//            str_overwrite_stdout();
        } else if (receive == 0) {
            break;
        } else { 
            // -1 
        }
    }
}

void* send_msg_handler(void* a) {
    char message[LENGTH_MSG] = {};
    while (1) {
//        str_overwrite_stdout();
        while (fgets(message, LENGTH_MSG, stdin) != NULL) {
            str_trim_lf(message, LENGTH_MSG);
            if (strlen(message) == 0) {
//                str_overwrite_stdout();
            } else {
                break;
            }
        }
        send(sockfd, message, LENGTH_MSG, 0);
        if (strcmp(message, "exit") == 0) {
            break;
        }
    }
    catch_ctrl_c_and_exit(2);
}
void case1(){
	char file_chatlog[50] = {};
	char file_info[50] = {};
	sprintf(file_chatlog,"%d",roomPort);
	strcat(file_chatlog,"_chatlog.txt");
	sprintf(file_info,"%d",roomPort);
	strcat(file_info,"_info.txt");
	char mess[200] = {};
	char room_info[200] = {};
	strcpy(room_info,"Room info: ");
	strcpy(mess,"");
	Write(file_chatlog,mess);
	Write(file_info,room_info);
			
	
}
void printMenu(){
	int choose;
	char chRoomPort[20] = {};
	do{
		printf("---------MENU----------\n");
		printf("1.Create Room\n");
		printf("2.Join Room\n");
		printf("3.Exit\n");	
		printf("=======================\n");
		printf("Nhập lựa chọn:\n");
		scanf("%d",&choose);
		
	}
	while(choose<1 || choose>3);
	switch(choose){
		case 1:
			printf("You created a room with ID: %d\n",roomPort);
			printf("You are admin!\n");
			send(sockfd, chRoomPort, 20, 0);
			case1();
			break;
		case 2:
			printf("Enter room ID:\n");
			while (fgets(chRoomPort, 20, stdin) != NULL) {
				str_trim_lf(chRoomPort, 20);
				if (strlen(chRoomPort) == 0) {
	//                str_overwrite_stdout();
				} else {
					break;
				}
			}
			send(sockfd, chRoomPort, 20, 0);
			break;
		case 3:
			flag = 1;
			break;
	}
	
}
int main()
{
    signal(SIGINT, catch_ctrl_c_and_exit);
	
    // Naming
    printf("Please enter your name: ");
    if (fgets(nickname, LENGTH_NAME, stdin) != NULL) {
        str_trim_lf(nickname, LENGTH_NAME);
    }
    if (strlen(nickname) < 2 || strlen(nickname) >= LENGTH_NAME-1) {
        printf("\nName must be more than one and less than thirty characters.\n");
        exit(EXIT_FAILURE);
    }
    // Create socket
    sockfd = socket(AF_INET , SOCK_STREAM , 0);
    if (sockfd == -1) {
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
    server_info.sin_addr.s_addr = inet_addr("127.0.0.1");
    server_info.sin_port = htons(8888);

    // Connect to Server
    int err = connect(sockfd, (struct sockaddr *)&server_info, s_addrlen);
    if (err == -1) {
        printf("Connection to Server error!\n");
        exit(EXIT_FAILURE);
    }
    
    // Names
    getsockname(sockfd, (struct sockaddr*) &client_info, (socklen_t*) &c_addrlen);
    getpeername(sockfd, (struct sockaddr*) &server_info, (socklen_t*) &s_addrlen);
    printf("Connect to Server: %s:%d\n", inet_ntoa(server_info.sin_addr), ntohs(server_info.sin_port));
    printf("You are: %s:%d\n", inet_ntoa(client_info.sin_addr), ntohs(client_info.sin_port));
	
    send(sockfd, nickname, LENGTH_NAME, 0);

	roomPort = ntohs(client_info.sin_port);
	
	printMenu();
    pthread_t send_msg_thread;
    if (pthread_create(&send_msg_thread, NULL,send_msg_handler, NULL) != 0) {
        printf ("Create pthread error!\n");
        exit(EXIT_FAILURE);
    }
    pthread_t recv_msg_thread;
    if (pthread_create(&recv_msg_thread, NULL,recv_msg_handler, NULL) != 0) {
        printf ("Create pthread error!\n");
        exit(EXIT_FAILURE);
    }

    while (1) {
        if(flag) {
            printf("\nBye\n");
            break;
        }
    }

    close(sockfd);
    return 0;
}
