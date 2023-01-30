<p align="center"><img src="https://www.kukulkan.in/img/logo.png"></p>


> **Laravel Version:** >= Laravel v7.0

> **PHP Version:** >= PHP v7.2.5

> **Technologies Used:** HTML, CSS, JavaScript, Bootstrap, jQuery, Laravel, MySQL

> **Module Users:** Candidates, Employers, Admin, Staffs

# Project Brief

**Kukulkan** is a job consulting and application tracker system where candidates can able to update their professional information, upload resume and employers can post their job requirements, eventually, the consultancy admin and their staffs can map and manage the job requirements with suitable candidates accordingly.

# Functionalities
<h4>USER END</h4>

 - Candidates can able to fill an application form that includes all basic personal and contact details, experience, education and upload resume.
 - Employers can able to fill an application form that includes all basic personal and contact details and job posting details.

<h4>ADMIN END</h4>

 - Powered by dashboard that symbolizes the summary of candidates, employers, job postings with count, graph, pie chart.
 - Candidates and Employers are categorized into three types respectively:
	 - **Approved:** Candidates/Employers that are verified by admin/staff who applied from user end.
	 - **New:** List of candidates/employers  who applied from user end.
	 - **Add:** Admin/Staff can add candidates/employers  manually without any approval.
- All approved jobs are available to manage.
- Candidates/Employers/Job details can able to view, edit, delete by admin whereas staff only authorized to view only.
- Candidates follow up made easy by status update with description.
 - Available cms for site details and basic seo management.
 - Bulk candidates upload is available that can be parsed from csv formatted excel file.

# Technical Notes

 - No migrations are created since the project is upgraded from Core PHP. So, direct sql file is used. Sample SQL file is included.
 - Eloquent relationships are avoided because the project needed better scalability that consists of large data. So, raw join queries with query builder is added to read faster from the database.
 - Individual requests are created for better server validations.
 - Helper controller is added for single inheritance that reused.
 - **Laravel auth ui** is used for authentication.
 - **Maatwebsite** package is used for csv file parser.