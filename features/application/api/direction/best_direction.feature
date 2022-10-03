@api @direction @bestDirection
Feature: Direction weather
  In order to get best direction weather data in JSON format
  As a developer
  I want to see weather data in JSON format

  Scenario: Successful return weather for single direction
    When I send a GET request on '/api/v1/weather/Cairo'
    Then the response status code should be 200
    And should contain headers:
    """
    {
      "content-type": "application/json"
    }
    """
    And should contain json:
    """
    {
      "search": ["Cairo"],
      "bestDirection": {
        "region": "Cairo, Egypt",
        "score": 242,
        "temperature": 25,
        "rainfall": 0,
        "humidity": 36,
        "wind": 8
      },
      "directions": [
        {
          "region": "Cairo, Egypt",
          "score": 242,
          "temperature": 25,
          "rainfall": 0,
          "humidity": 36,
          "wind": 8
        }
      ]
    }
    """

  Scenario: Successful return weather for many directions
    When I send a GET request on '/api/v1/weather/London,Cairo'
    Then the response status code should be 200
    And should contain headers:
    """
    {
      "content-type": "application/json"
    }
    """
    And should contain json:
    """
    {
      "search": ["London", "Cairo"],
      "bestDirection": {
        "region": "Cairo, Egypt",
        "score": 242,
        "temperature": 25,
        "rainfall": 0,
        "humidity": 36,
        "wind": 8
      },
      "directions": [
        {
          "region": "Cairo, Egypt",
          "score": 242,
          "temperature": 25,
          "rainfall": 0,
          "humidity": 36,
          "wind": 8
        },
        {
          "region": "London, UK",
          "score": 70,
          "temperature": 13,
          "rainfall": 2,
          "humidity": 60,
          "wind": 5
        }
      ]
    }
    """
