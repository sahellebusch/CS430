SELECT last_name, first_name, DATE, present
FROM person, event, attendance_event
WHERE person.p_id = attendance_event.p_id
AND attendance_event.e_id = event.e_id
AND date = '2014-03-27' ---> this needs to be changed, to get the meeting by date!
GROUP BY last_name
