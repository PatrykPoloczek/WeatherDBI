# PHP API Code Assessment

## Calculate and return from API best travel direction

Given there is the endpoint to search the best direction when a user
of API gives direction names separated coma, then API should find
the weather of the direction and calculate the score. Finally,
API should return the best direction.

```text
/api/v1/weather/{search}
```

Example:

```text
/api/v1/weather/London,Cairo
```

There is implemented integration with the weather service in the API service 
to get information about the weather of the travel direction.

> URL: https://weatherdbi.herokuapp.com/data/weather/Cairo

> Local mock URL: http://172.33.100.1:8080/data/weather/Cairo

### Direction weather score

Weather score calculation algorithm based on the next days of the direction weather:

- if the maximum temperature of each day is from 15 to 25 then add 10 points;
- if the maximum temperature of each day is from 26 to 32 then add 20 points;
- if the weather description of each day is equal **"Sunny"** then add 10 points;
- if the weather description of each day is equal **"Mostly sunny"** then add 20 points;

> First example: A day's maximum temperature is 18°C and is not sunny should give 10 points.

> Second Example: A day's maximum temperature is 27°C and is sunny should give 30 points.

> Third Example: The first day's maximum temperature is 18 ° C, the second day's maximum temperature is 27 ° C and the days are sunny should give 50 points.
Then add bonus by the current weather:

- if the current rainfall is equal to 0 then increase by 10%;
- if the current wind with rainfall is equal to 0 then increase by 20%;
- if the current humidity is between 40 and 70 and wind with rainfall is equal to 0 then increase by 30%;

> Example: A score of 100 when current weather is without wind and rainfall should give 120 points (100 + 20%).

The maximum weather score is 416.

### Returned model

Return DTO model `Result` should contain:

- The search values as array `$search`
- The best direction with the most score `$bestDirection`
- The list of the directions found `$directions`

All direction DTO model `Direction` should contain:

- The region name found `$region`
- The calculated score `$score`
- The current temperature `$temperature`
- The current rainfall `$rainfall`
- The current humidity `$humidity`
- The current wind `$wind`

### Sort direction and return best direction

All directions found should be sorted by the score from greater to lower in the result.

## Summary

1. Do not modify communication with the external service in the infrastructure.
2. Do not use external resources, like components, libraries, and helpers.
3. You can use helps on the internet like documentation and forums
4. Stick to best practices of programming and design patterns.

## Additional information

When You will decide that you would like run the project on the local machine. 
You have to install `docker` and `docker-compose`. After installation, 
You can and build run the project using the command:

```bash
docker-compose up -d
docker-compose exec cli composer run build
```

Now, you can implement the algorithm and run tests by the command:

```bash
docker-compose exec cli composer test
```

You can test service in your browser:
> URL http://172.33.100.1/doc
