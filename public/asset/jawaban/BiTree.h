#include "boolean.h"
#define Nil NULL
typedef int infotype;
typedef struct tNode *address;
typedef struct tNode {
	infotype Info;
	address Left;
	address Right;
} node;
typedef address BinTree;
#define Akar(P) (P)->Info
#define Left(P) (P)->Left
#define Right(P) (P)->Right

BinTree CreateBinTree(BinTree *P);

BinTree MakeTree (infotype Akar);

BinTree InsertNode(BinTree P, infotype X);

boolean IsTreeEmpty (BinTree P);

boolean Search (BinTree P, infotype X);

address FindMin(BinTree P);

address FindMax(BinTree P);

BinTree DeleteNode (BinTree P, infotype X);

BinTree PrintPreOrder(BinTree P);
