#include <iostream>

using namespace std;

class Box
{
    public:
        double length;
        void setWidth( double wid );
        double getWidth( void );
    private:
        double width;
};

double Box::getWidth(void)
{
    return width;
}

void Box::setWidth( double wid )
{
    width = wid;
}

int main()
{
    Box box;

    box.length = 10.0;
    cout << "Length of box: " << box.length << endl;

    box.setWidth(10.0);
    cout << "Width of box: " << box.getWidth() << endl;

    return 0;
}
