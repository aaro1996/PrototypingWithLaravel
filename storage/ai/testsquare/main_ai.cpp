#include <stdlib.h>
#include <stdio.h>
#include <iostream>

using namespace std;

int main(int argc, char* argv[]) {
	if (argc != 2) {
		cout << "failed\n" << flush;
	} else {
		cout << argv[1] << flush;
	}
	
}