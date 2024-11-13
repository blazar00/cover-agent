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


def test_is_prime_non_prime_number():
    response = client.get("/is-prime/4")
    assert response.status_code == 200
    assert response.json() == {"is_prime": False}


def test_is_prime_prime_number():
    response = client.get("/is-prime/7")
    assert response.status_code == 200
    assert response.json() == {"is_prime": True}


def test_is_prime_less_than_two():
    response = client.get("/is-prime/1")
    assert response.status_code == 200
    assert response.json() == {"is_prime": False}


def test_current_time():
    response = client.get("/current-time")
    assert response.status_code == 200
    assert "time" in response.json()
