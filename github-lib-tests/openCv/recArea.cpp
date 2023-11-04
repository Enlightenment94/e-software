#include <opencv2/highgui.hpp>
#include <iostream>
#include <opencv2/core/core.hpp>
#include <opencv2/imgproc.hpp> 

// zmienne globalne przechowujące współrzędne punktu początkowego i końcowego prostokąta
cv::Point start_pt(-1, -1);
cv::Point end_pt(-1, -1);

// Zmienna flagi określająca, czy wciśnięty jest lewy przycisk myszy
bool lbutton_down = false;

using namespace cv; 
using namespace std;

cv::Mat draw_rectangle(cv::Mat input, cv::Point p1, cv::Point p2) {
    cv::Mat output = input.clone();
    int thickness = 2;
    cv::Scalar color(0, 255, 0);
    int lineType = cv::LINE_8;
    int shift = 0;
    cv::rectangle(output, p1, p2, color, thickness, lineType, shift);

    return output;
}

void on_mouse(int event, int x, int y, int flags, void* userdata) {
    static cv::Mat original_desktop = *((cv::Mat*)userdata);
    cv::Mat desktop = *((cv::Mat*)userdata);

    if (event == cv::EVENT_MOUSEMOVE) {
        if (lbutton_down) {
            end_pt = cv::Point(x, y);
            desktop = original_desktop.clone();
            desktop = draw_rectangle(desktop, start_pt, end_pt);
            cv::imshow("Screen", desktop);
        }
    }
    if (event == cv::EVENT_LBUTTONDOWN) {  
        start_pt = cv::Point(x, y); 
        lbutton_down = true;
    }
    else if (event == cv::EVENT_LBUTTONUP) {  
        end_pt = cv::Point(x, y); 
        original_desktop = desktop.clone();
        desktop = draw_rectangle(desktop, start_pt, end_pt);
        lbutton_down = false;
        cv::imshow("Screen", desktop);
        *((cv::Mat*)userdata) = desktop.clone();
    }
}

int main() {
    system("scrot -d 1 screenshot.png");

    cv::Mat desktop = cv::imread("screenshot.png", cv::IMREAD_UNCHANGED);
    cv::Mat original_desktop = desktop.clone();

    cv::namedWindow("Screen", cv::WINDOW_NORMAL);
    cv::setWindowProperty("Screen", cv::WND_PROP_FULLSCREEN, cv::WINDOW_FULLSCREEN);
    cv::setWindowProperty("Screen", cv::WND_PROP_AUTOSIZE, cv::WINDOW_AUTOSIZE);
    cv::imshow("Screen", desktop);

    cv::setMouseCallback("Screen", on_mouse, &desktop);
    
    int key = 0;
    while (key != 27) {
        key = cv::waitKey(0);
    }

    return 0;
}