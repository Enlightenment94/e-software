import cv2
import time
import numpy as np

def breakCaptch(path):
	# Załadowanie obrazu
	img = cv2.imread(path)

	# Konwersja do skali szarości
	gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

	# Wykrycie krawędzi algorytmem Canny
	edges = cv2.Canny(gray, 100, 200)

	cv2.imwrite("./tmp/1.png", edges)
	# Wyświetlenie obrazu z wykrytymi krawędziami
	cv2.imshow('Edges', edges)
	cv2.waitKey(0)
	cv2.destroyAllWindows()

def breakCaptch1(path, threshold):
	img = cv2.imread(path)

	gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
	_, thresh = cv2.threshold(gray, 100, 255, cv2.THRESH_BINARY)
	contours, hierarchy = cv2.findContours(thresh, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

	# Obliczenie powierzchni każdego konturu wraz z wypisanymi powierzchniami na obrazie
	for i, cnt in enumerate(contours):
	    area = cv2.contourArea(cnt)
	    print("Powierzchnia obszaru " + str(i) + ": " + str(area))
	    cv2.putText(img, str(area), (10, 30 + i * 20), cv2.FONT_HERSHEY_SIMPLEX, 0.5, 255, 1, cv2.LINE_AA)

	sorted_contours = sorted(contours, key=lambda x: cv2.contourArea(x), reverse=True)
	largest_contours = sorted_contours[:200]
	print(len(largest_contours))
	i = 0
	for i, contour in enumerate(contours):
		area = cv2.contourArea(contour)
		if area > threshold:
			mask = np.zeros(gray.shape, np.uint8)
			cv2.drawContours(mask, [contour], 0, 255, -1)
			cv2.drawContours(img, [contour], 0, (0, 0, 255), 2)
			result = cv2.bitwise_and(img, img, mask=mask)
			result[result == 0] = (0, 255, 0)

	cv2.imshow('Contours',img)
	"""
	for contour in largest_contours:
		cv2.drawContours(img, [contour], 0, (0, 0, 255), 2)
		cv2.fillPoly(img, [contour], (0, 255, 0))
		#time.sleep(2)
		print("one")
		print(contour)
		cv2.imshow('Contours',img)
	"""

	# Wyświetlenie obrazu z zaznaczonymi powierzchniami
	cv2.waitKey(0)
	cv2.destroyAllWindows()