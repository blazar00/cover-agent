import pytest
from fastapi.testclient import TestClient
from app import app
from datetime import date

client = TestClient(app)

def test_root():
    """
    Test the root endpoint by sending a GET request to "/" and checking the response status code and JSON body.
    """
    response = client.get("/")
    assert response.status_code == 200
    assert response.json() == {"message": "Welcome to the FastAPI application!"}



def test_is_palindrome_true():
    response = client.get("/is-palindrome/racecar")
    assert response.status_code == 200
    assert response.json() == {"is_palindrome": True}


def test_divide_by_zero():
    response = client.get("/divide/10/0")
    assert response.status_code == 400
    assert response.json() == {"detail": "Cannot divide by zero"}


def test_add_positive_integers():
    response = client.get("/add/3/5")
    assert response.status_code == 200
    assert response.json() == {"result": 8}


def test_current_date():
    response = client.get("/current-date")
    assert response.status_code == 200
    assert response.json() == {"date": date.today().isoformat()}
