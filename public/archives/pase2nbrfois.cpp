#include<iostream>
using namespace std;
 
int main()
{
int a[10],nb[21],i;
 
for(i=0;i<10;i++)
{
        do {cout<<"Veuillez taper l'entier numero "<<i<<" : ";cin>>a[i];}
                while (a[i]>20 || a[i]<0);
}
 
for(i=0;i<21;i++)nb[i]=0;
for(i=0;i<10;i++)nb[a[i]]++;
 
for(i=0;i<21;i++){cout<<"Il y a "<<nb[i]<<" fois l'entier "<<i<<endl;}
system("pause");
return 0;
}
