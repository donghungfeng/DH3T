#ifndef LIST
#define LIST

typedef struct ClientNode {
    int data;
    struct ClientNode* prev;
    struct ClientNode* link;
    char ip[16];
	int id;
	int roomPort;
    char name[31];
	char role[10];
	int isBan;
} ClientList;

ClientList *newNode(int sockfd, char* ip) {
    ClientList *np = (ClientList *)malloc( sizeof(ClientList) );
    np->data = sockfd;
    np->prev = NULL;
    np->link = NULL;
    strncpy(np->ip, ip, 16);
    strncpy(np->name, "NULL", 5);
	strncpy(np->role, "user", 5);
	np->isBan = 0;
	np->id = 0;
	np->roomPort = 0;
    return np;
}

#endif // LIST