#include <opencv2/highgui.hpp>
#include <iostream>
#include <opencv2/core/core.hpp>
#include <opencv2/imgproc.hpp> 

int main() {
    // Inicjalizacja obiektu nagrywania wideo
    cv::VideoWriter video("output.avi", cv::VideoWriter::fourcc('M', 'J', 'P', 'G'), 10, cv::Size(1920, 1080));

    // Inicjalizacja obiektu przechwytywania ekranu
    cv::VideoCapture screen_capture(cv::CAP_ANY);

    if (!screen_capture.isOpened()) {
        std::cout << "Nie można otworzyć przechwytywania ekranu." << std::endl;
        return -1;
    }

    cv::Mat frame;

    while (true) {
        // Przechwytywanie klatki z ekranu
        screen_capture >> frame;

        if (frame.empty()) {
            std::cout << "Pusta klatka." << std::endl;
            break;
        }

        // Zapisywanie klatki do pliku wideo
        video.write(frame);

        // Wyświetlanie klatki na ekranie
        cv::imshow("Nagrywanie pulpitu", frame);

        // Wyjście z pętli po naciśnięciu klawisza 'q'
        if (cv::waitKey(1) == 'q') {
            break;
        }
    }

    // Zwalnianie zasobów
    screen_capture.release();
    video.release();
    cv::destroyAllWindows();

    return 0;
}
