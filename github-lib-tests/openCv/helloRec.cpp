#include "opencv2/videoio.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"

#include <ctype.h>
#include <stdio.h>
#include <iostream>
using namespace cv;
using namespace std;

int main() {

    // obszar do nagrywania (od lewego górnego rogu)
    int screen_x = 0;
    int screen_y = 0;
    int screen_width = 640;
    int screen_height = 480;

    // przygotowanie obiektu do zapisu wideo
    VideoWriter writer("output.avi", VideoWriter::fourcc('M','J','P','G'), 25, Size(screen_width, screen_height));

    if (!writer.isOpened()) {
        cout << "Error: Could not open video file" << endl;
        return -1;
    }

    // pętla nagrywania
    Mat frame = cv::Mat(cv::Size(640, 480), CV_8UC4, cv::Scalar(255, 255, 255, 177));
    int width = frame.size().width;
    int height = frame.size().height;
    cout << "Szerokość: " << width << endl;
    cout << "Wysokość: " << height << endl;
    while (true) {
        // wykonanie zrzutu ekranu z pomocą biblioteki ffmpeg
        VideoCapture capture("x11grab");  // wybranie źródła obrazu (ekran)
        //capture.set(CAP_PROP_XI, screen_x);  // ustawienie współrzędnej X obszaru do nagrywania
        //capture.set(CAP_PROP_YI, screen_y);  // ustawienie współrzędnej Y obszaru do nagrywania
        capture.set(CAP_PROP_FRAME_WIDTH, width);  // ustawienie szerokości nagrywanego obszaru
        capture.set(CAP_PROP_FRAME_HEIGHT, height);  // ustawienie wysokości nagrywanego obszaru
        capture.read(frame);  // wykonanie zrzutu
        //capture.release();  // zwolnienie zasobów

        // zapisanie klatki wideo
        //writer.write(frame);

        // wyświetlenie klatki wideo na ekranie
        imshow("Recording", frame);

        // oczekiwanie na naciśnięcie klawisza 'q' w celu zakończenia nagrywania
        if (waitKey(1) == 'q')
            break;
    }

    // zwolnienie zasobów
    writer.release();
    destroyAllWindows();

    return 0;
}