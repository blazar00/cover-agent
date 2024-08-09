import sqlite3
import csv

# Connect to the SQLite database
conn = sqlite3.connect('test_runs.db')
cursor = conn.cursor()

# Get the list of all tables
cursor.execute("SELECT name FROM sqlite_master WHERE type='table';")
tables = cursor.fetchall()

for table_name in tables:
    table_name = table_name[0]
    cursor.execute(f"SELECT * FROM {table_name}")
    rows = cursor.fetchall()
    
    # Get column names
    column_names = [description[0] for description in cursor.description]
    
    # Write to CSV file
    with open(f"{table_name}.csv", 'w', newline='') as csv_file:
        writer = csv.writer(csv_file)
        writer.writerow(column_names)
        writer.writerows(rows)

# Close the connection
conn.close()