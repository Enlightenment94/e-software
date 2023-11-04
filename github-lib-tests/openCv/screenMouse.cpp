#include <opencv2/highgui.hpp>
#include <iostream>

int main() {
    system("scrot -d 1 screenshot.png");

    cv::Mat desktop = cv::imread("screenshot.png", cv::IMREAD_UNCHANGED);

    cv::namedWindow("Screen", cv::WINDOW_NORMAL);
    cv::setWindowProperty("Screen", cv::WND_PROP_FULLSCREEN, cv::WINDOW_FULLSCREEN);
    cv::setWindowProperty("Screen", cv::WND_PROP_AUTOSIZE, cv::WINDOW_AUTOSIZE);
    cv::imshow("Screen", desktop);

    cv::setMouseCallback("Screen", [](int event, int x, int y, int flags, void* userdata) {
        if (event == cv::EVENT_MOUSEMOVE) {
            std::cout << "Mouse Position: (" << x << ", " << y << ")" << std::endl;
        }
    }, nullptr);

    cv::imshow("Screen", desktop);
    
    cv::waitKey(0);

    return 0;
}
