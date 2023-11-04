#include <opencv2/highgui.hpp>
#include <iostream>
#include <opencv2/core/core.hpp>
#include <opencv2/imgproc.hpp> 

// zmienne globalne przechowujące współrzędne punktu początkowego i końcowego prostokąta
cv::Point start_pt(-1, -1);
cv::Point end_pt(-1, -1);

using namespace cv; 
using namespace std;

int main() {
    system("scrot -d 1 screenshot.png");

    cv::Mat desktop = cv::imread("screenshot.png", cv::IMREAD_UNCHANGED);

    cv::namedWindow("Screen", cv::WINDOW_NORMAL);
    cv::setWindowProperty("Screen", cv::WND_PROP_FULLSCREEN, cv::WINDOW_FULLSCREEN);
    cv::setWindowProperty("Screen", cv::WND_PROP_AUTOSIZE, cv::WINDOW_AUTOSIZE);
    cv::imshow("Screen", desktop);

    cv::setMouseCallback("Screen", [](int event, int x, int y, int flags, void* userdata) {
        if (event == cv::EVENT_MOUSEMOVE) {
            //std::cout << "Mouse Position: (" << x << ", " << y << ")" << std::endl;
        }
        if (event == cv::EVENT_LBUTTONDOWN) {  
            start_pt = cv::Point(x, y); 
            cout << "start_pt: " << start_pt << "\n"; 
        }
        else if (event == cv::EVENT_MOUSEMOVE && (flags & cv::EVENT_FLAG_LBUTTON)) { 
            end_pt = cv::Point(x, y);  
            cout << "end_pt: " << end_pt << "\n"; 
            cv::rectangle(*((cv::Mat*)userdata), start_pt, end_pt, cv::Scalar(255, 255, 255), 2);  
            cv::imshow("Screen", *((cv::Mat*)userdata));
        }
        else if (event == cv::EVENT_LBUTTONUP) {  
            end_pt = cv::Point(x, y);  
            cout << "end_pt_up: " << end_pt << "\n";
            cv::rectangle(*((cv::Mat*)userdata), start_pt, end_pt, cv::Scalar(255, 255, 255), 2);  
            cv::imshow("Screen", *((cv::Mat*)userdata));
        }
    }, &desktop);

    int key = 0;
    while (key != 27) {
        key = cv::waitKey(0);
        cout << key;
    }

    return 0;
}
