@php
    $selectedValue = $selected ?? null;
@endphp
<optgroup label="🏗️ Engineering Specializations">
    <option value="Architecture" {{ $selectedValue == 'Architecture' ? 'selected' : '' }}>Architecture</option>
    <option value="Civil Engineering" {{ $selectedValue == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
    <option value="Electrical Engineering" {{ $selectedValue == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
    <option value="Mechanical Engineering" {{ $selectedValue == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
    <option value="Industrial Engineering" {{ $selectedValue == 'Industrial Engineering' ? 'selected' : '' }}>Industrial Engineering</option>
    <option value="Computer Engineering" {{ $selectedValue == 'Computer Engineering' ? 'selected' : '' }}>Computer Engineering</option>
    <option value="Computer Science" {{ $selectedValue == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
    <option value="Information Technology" {{ $selectedValue == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
    <option value="Cybersecurity" {{ $selectedValue == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
    <option value="Artificial Intelligence" {{ $selectedValue == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
    <option value="Chemical Engineering" {{ $selectedValue == 'Chemical Engineering' ? 'selected' : '' }}>Chemical Engineering</option>
    <option value="Software Engineering" {{ $selectedValue == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
</optgroup>

<optgroup label="📚 Literary and Humanities Specializations">
    <option value="Arabic Language" {{ $selectedValue == 'Arabic Language' ? 'selected' : '' }}>Arabic Language</option>
    <option value="English Language" {{ $selectedValue == 'English Language' ? 'selected' : '' }}>English Language</option>
    <option value="History" {{ $selectedValue == 'History' ? 'selected' : '' }}>History</option>
    <option value="Geography" {{ $selectedValue == 'Geography' ? 'selected' : '' }}>Geography</option>
    <option value="Media" {{ $selectedValue == 'Media' ? 'selected' : '' }}>Media</option>
    <option value="Public Relations" {{ $selectedValue == 'Public Relations' ? 'selected' : '' }}>Public Relations</option>
    <option value="Journalism and Publishing" {{ $selectedValue == 'Journalism and Publishing' ? 'selected' : '' }}>Journalism and Publishing</option>
    <option value="Psychology" {{ $selectedValue == 'Psychology' ? 'selected' : '' }}>Psychology</option>
    <option value="Social Work" {{ $selectedValue == 'Social Work' ? 'selected' : '' }}>Social Work</option>
    <option value="Sociology" {{ $selectedValue == 'Sociology' ? 'selected' : '' }}>Sociology</option>
    <option value="Education" {{ $selectedValue == 'Education' ? 'selected' : '' }}>Education</option>
</optgroup>


<optgroup label="💼 Administrative and Financial Specializations">
    <option value="Business Administration" {{ $selectedValue == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
    <option value="Accounting" {{ $selectedValue == 'Accounting' ? 'selected' : '' }}>Accounting</option>
    <option value="Marketing" {{ $selectedValue == 'Marketing' ? 'selected' : '' }}>Marketing</option>
    <option value="Economics" {{ $selectedValue == 'Economics' ? 'selected' : '' }}>Economics</option>
    <option value="Finance" {{ $selectedValue == 'Finance' ? 'selected' : '' }}>Finance</option>
    <option value="Management Information Systems" {{ $selectedValue == 'Management Information Systems' ? 'selected' : '' }}>Management Information Systems</option>
    <option value="Human Resources" {{ $selectedValue == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
    <option value="Public Administration" {{ $selectedValue == 'Public Administration' ? 'selected' : '' }}>Public Administration</option>
</optgroup>

<optgroup label="🎨 Art and Design Specializations">
    <option value="Graphic Design" {{ $selectedValue == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
    <option value="Interior Design" {{ $selectedValue == 'Interior Design' ? 'selected' : '' }}>Interior Design</option>
    <option value="Fine Arts" {{ $selectedValue == 'Fine Arts' ? 'selected' : '' }}>Fine Arts</option>
    <option value="Photography" {{ $selectedValue == 'Photography' ? 'selected' : '' }}>Photography</option>
    <option value="Fashion Design" {{ $selectedValue == 'Fashion Design' ? 'selected' : '' }}>Fashion Design</option>
    <option value="Film Production" {{ $selectedValue == 'Film Production' ? 'selected' : '' }}>Film Production</option>
</optgroup>

<optgroup label="📈 Business and Marketing Specializations">
    <option value="International Trade" {{ $selectedValue == 'International Trade' ? 'selected' : '' }}>International Trade</option>
    <option value="Digital Marketing" {{ $selectedValue == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
    <option value="Project Management" {{ $selectedValue == 'Project Management' ? 'selected' : '' }}>Project Management</option>
    <option value="Supply Chain (Logistics)" {{ $selectedValue == 'Supply Chain (Logistics)' ? 'selected' : '' }}>Supply Chain (Logistics)</option>
    <option value="E-Commerce" {{ $selectedValue == 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
    <option value="Business Data Analysis" {{ $selectedValue == 'Business Data Analysis' ? 'selected' : '' }}>Business Data Analysis</option>
    <option value="Business Development" {{ $selectedValue == 'Business Development' ? 'selected' : '' }}>Business Development</option>
</optgroup>

<optgroup label="🌍 Environmental and Agricultural Specializations">
    <option value="Agriculture" {{ $selectedValue == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
    <option value="Environmental Science" {{ $selectedValue == 'Environmental Science' ? 'selected' : '' }}>Environmental Science</option>
    <option value="Natural Resource Management" {{ $selectedValue == 'Natural Resource Management' ? 'selected' : '' }}>Natural Resource Management</option>
    <option value="Ocean Sciences" {{ $selectedValue == 'Ocean Sciences' ? 'selected' : '' }}>Ocean Sciences</option>
    <option value="Renewable Energy" {{ $selectedValue == 'Renewable Energy' ? 'selected' : '' }}>Renewable Energy</option>
    <option value="Agricultural Engineering" {{ $selectedValue == 'Agricultural Engineering' ? 'selected' : '' }}>Agricultural Engineering</option>
    <option value="Aerospace" {{ $selectedValue == 'Aerospace' ? 'selected' : '' }}>Aerospace</option>
</optgroup>

<optgroup label="⚖️ Legal and Political Specializations">
    <option value="Civil Law" {{ $selectedValue == 'Civil Law' ? 'selected' : '' }}>Civil Law</option>
    <option value="Criminal Law" {{ $selectedValue == 'Criminal Law' ? 'selected' : '' }}>Criminal Law</option>
    <option value="International Law" {{ $selectedValue == 'International Law' ? 'selected' : '' }}>International Law</option>
    <option value="Human Rights" {{ $selectedValue == 'Human Rights' ? 'selected' : '' }}>Human Rights</option>
    <option value="Public Policy" {{ $selectedValue == 'Public Policy' ? 'selected' : '' }}>Public Policy</option>
    <option value="Political Science" {{ $selectedValue == 'Political Science' ? 'selected' : '' }}>Political Science</option>
    <option value="International Relations" {{ $selectedValue == 'International Relations' ? 'selected' : '' }}>International Relations</option>
    <option value="Crisis and Disaster Management" {{ $selectedValue == 'Crisis and Disaster Management' ? 'selected' : '' }}>Crisis and Disaster Management</option>
</optgroup>

<optgroup label="🧠 Brain and Behavioral Sciences Specializations">
    <option value="Neuroscience" {{ $selectedValue == 'Neuroscience' ? 'selected' : '' }}>Neuroscience</option>
    <option value="Neuropsychology" {{ $selectedValue == 'Neuropsychology' ? 'selected' : '' }}>Neuropsychology</option>
    <option value="Behavioral Science" {{ $selectedValue == 'Behavioral Science' ? 'selected' : '' }}>Behavioral Science</option>
    <option value="Autism Studies" {{ $selectedValue == 'Autism Studies' ? 'selected' : '' }}>Autism Studies</option>
    <option value="Addiction Studies" {{ $selectedValue == 'Addiction Studies' ? 'selected' : '' }}>Addiction Studies</option>
    <option value="Psychotherapy" {{ $selectedValue == 'Psychotherapy' ? 'selected' : '' }}>Psychotherapy</option>
</optgroup>

<optgroup label="🏛️ Social and Intellectual Specializations">
    <option value="Philosophy" {{ $selectedValue == 'Philosophy' ? 'selected' : '' }}>Philosophy</option>
    <option value="Comparative Literature" {{ $selectedValue == 'Comparative Literature' ? 'selected' : '' }}>Comparative Literature</option>
    <option value="Cultural Studies" {{ $selectedValue == 'Cultural Studies' ? 'selected' : '' }}>Cultural Studies</option>
    <option value="Anthropology" {{ $selectedValue == 'Anthropology' ? 'selected' : '' }}>Anthropology</option>
    <option value="Middle Eastern Studies" {{ $selectedValue == 'Middle Eastern Studies' ? 'selected' : '' }}>Middle Eastern Studies</option>
    <option value="Religious Studies" {{ $selectedValue == 'Religious Studies' ? 'selected' : '' }}>Religious Studies</option>
    <option value="Performing Arts" {{ $selectedValue == 'Performing Arts' ? 'selected' : '' }}>Performing Arts</option>
</optgroup>

<optgroup label="⚙️ Mechatronics and Robotics Specializations">
    <option value="Mechatronics Engineering" {{ $selectedValue == 'Mechatronics Engineering' ? 'selected' : '' }}>Mechatronics Engineering</option>
    <option value="Robotics" {{ $selectedValue == 'Robotics' ? 'selected' : '' }}>Robotics</option>
    <option value="Automation and Control" {{ $selectedValue == 'Automation and Control' ? 'selected' : '' }}>Automation and Control</option>
    <option value="3D Printing" {{ $selectedValue == '3D Printing' ? 'selected' : '' }}>3D Printing</option>
    <option value="Embedded Systems" {{ $selectedValue == 'Embedded Systems' ? 'selected' : '' }}>Embedded Systems</option>
</optgroup>

<optgroup label="💻 Programming and Modern Technology Specializations">
    <option value="Game Development" {{ $selectedValue == 'Game Development' ? 'selected' : '' }}>Game Development</option>
    <option value="Data Analysis" {{ $selectedValue == 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
    <option value="Programming (Java, Python, C++)" {{ $selectedValue == 'Programming (Java, Python, C++)' ? 'selected' : '' }}>Programming (Java, Python, C++)</option>
    <option value="App Development" {{ $selectedValue == 'App Development' ? 'selected' : '' }}>App Development</option>
    <option value="Web Development" {{ $selectedValue == 'Web Development' ? 'selected' : '' }}>Web Development</option>
    <option value="Networking" {{ $selectedValue == 'Networking' ? 'selected' : '' }}>Networking</option>
    <option value="Embedded Software Development" {{ $selectedValue == 'Embedded Software Development' ? 'selected' : '' }}>Embedded Software Development</option>
</optgroup>

<optgroup label="🌐 Languages and Translation Specializations">
    <option value="Linguistics" {{ $selectedValue == 'Linguistics' ? 'selected' : '' }}>Linguistics</option>
    <option value="Simultaneous Interpretation" {{ $selectedValue == 'Simultaneous Interpretation' ? 'selected' : '' }}>Simultaneous Interpretation</option>
    <option value="Literary Translation" {{ $selectedValue == 'Literary Translation' ? 'selected' : '' }}>Literary Translation</option>
    <option value="Technical Translation" {{ $selectedValue == 'Technical Translation' ? 'selected' : '' }}>Technical Translation</option>
    <option value="Legal Translation" {{ $selectedValue == 'Legal Translation' ? 'selected' : '' }}>Legal Translation</option>
    <option value="Eastern Languages (e.g., Chinese, Japanese, Korean)" {{ $selectedValue == 'Eastern Languages (e.g., Chinese, Japanese, Korean)' ? 'selected' : '' }}>Eastern Languages (e.g., Chinese, Japanese, Korean)</option>
</optgroup>

<optgroup label="💡 Modern Technical and Engineering Specializations">
    <option value="Software Engineering" {{ $selectedValue == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
    <option value="Artificial Intelligence" {{ $selectedValue == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
    <option value="Data Science and Analytics" {{ $selectedValue == 'Data Science and Analytics' ? 'selected' : '' }}>Data Science and Analytics</option>
    <option value="Mobile App Development" {{ $selectedValue == 'Mobile App Development' ? 'selected' : '' }}>Mobile App Development</option>
    <option value="Virtual and Augmented Reality (VR/AR)" {{ $selectedValue == 'Virtual and Augmented Reality (VR/AR)' ? 'selected' : '' }}>Virtual and Augmented Reality (VR/AR)</option>
    <option value="Smart Systems" {{ $selectedValue == 'Smart Systems' ? 'selected' : '' }}>Smart Systems</option>
    <option value="Tech Systems Management" {{ $selectedValue == 'Tech Systems Management' ? 'selected' : '' }}>Tech Systems Management</option>
    <option value="Embedded Systems" {{ $selectedValue == 'Embedded Systems' ? 'selected' : '' }}>Embedded Systems</option>
</optgroup>

<optgroup label="🎭 Arts and Media Specializations">
    <option value="Film and TV Production" {{ $selectedValue == 'Film and TV Production' ? 'selected' : '' }}>Film and TV Production</option>
    <option value="Digital Media" {{ $selectedValue == 'Digital Media' ? 'selected' : '' }}>Digital Media</option>
    <option value="Screenwriting" {{ $selectedValue == 'Screenwriting' ? 'selected' : '' }}>Screenwriting</option>
    <option value="Sound and Music Design" {{ $selectedValue == 'Sound and Music Design' ? 'selected' : '' }}>Sound and Music Design</option>
    <option value="Advertising and Public Relations" {{ $selectedValue == 'Advertising and Public Relations' ? 'selected' : '' }}>Advertising and Public Relations</option>
    <option value="Radio and TV Production" {{ $selectedValue == 'Radio and TV Production' ? 'selected' : '' }}>Radio and TV Production</option>
    <option value="Digital Game Design" {{ $selectedValue == 'Digital Game Design' ? 'selected' : '' }}>Digital Game Design</option>
    <option value="Animation" {{ $selectedValue == 'Animation' ? 'selected' : '' }}>Animation</option>
    <option value="Expressive Arts and Dance" {{ $selectedValue == 'Expressive Arts and Dance' ? 'selected' : '' }}>Expressive Arts and Dance</option>
</optgroup>

<optgroup label="🚀 Space and Aviation Specializations">
    <option value="Space Engineering" {{ $selectedValue == 'Space Engineering' ? 'selected' : '' }}>Space Engineering</option>
    <option value="Aeronautical Engineering" {{ $selectedValue == 'Aeronautical Engineering' ? 'selected' : '' }}>Aeronautical Engineering</option>
    <option value="Space Science" {{ $selectedValue == 'Space Science' ? 'selected' : '' }}>Space Science</option>
    <option value="Astrophysics" {{ $selectedValue == 'Astrophysics' ? 'selected' : '' }}>Astrophysics</option>
    <option value="Space Research and Exploration" {{ $selectedValue == 'Space Research and Exploration' ? 'selected' : '' }}>Space Research and Exploration</option>
</optgroup>

<optgroup label="💼 Management and Economics Specializations">
    <option value="International Project Management" {{ $selectedValue == 'International Project Management' ? 'selected' : '' }}>International Project Management</option>
    <option value="International Economics" {{ $selectedValue == 'International Economics' ? 'selected' : '' }}>International Economics</option>
    <option value="Risk Management" {{ $selectedValue == 'Risk Management' ? 'selected' : '' }}>Risk Management</option>
    <option value="Political Economy" {{ $selectedValue == 'Political Economy' ? 'selected' : '' }}>Political Economy</option>
    <option value="Strategic Marketing" {{ $selectedValue == 'Strategic Marketing' ? 'selected' : '' }}>Strategic Marketing</option>
    <option value="Financial Management" {{ $selectedValue == 'Financial Management' ? 'selected' : '' }}>Financial Management</option>
    <option value="Financial and Managerial Accounting" {{ $selectedValue == 'Financial and Managerial Accounting' ? 'selected' : '' }}>Financial and Managerial Accounting</option>
</optgroup>

<optgroup label="🧩 Mind and Behavior Studies Specializations">
    <option value="Behavioral Neuroscience" {{ $selectedValue == 'Behavioral Neuroscience' ? 'selected' : '' }}>Behavioral Neuroscience</option>
    <option value="Psychiatry" {{ $selectedValue == 'Psychiatry' ? 'selected' : '' }}>Psychiatry</option>
    <option value="Social Psychology" {{ $selectedValue == 'Social Psychology' ? 'selected' : '' }}>Social Psychology</option>
    <option value="Psychoanalysis" {{ $selectedValue == 'Psychoanalysis' ? 'selected' : '' }}>Psychoanalysis</option>
    <option value="Addiction and Treatment" {{ $selectedValue == 'Addiction and Treatment' ? 'selected' : '' }}>Addiction and Treatment</option>
    <option value="Autism Studies" {{ $selectedValue == 'Autism Studies' ? 'selected' : '' }}>Autism Studies</option>
    <option value="Art and Music Therapy" {{ $selectedValue == 'Art and Music Therapy' ? 'selected' : '' }}>Art and Music Therapy</option>
</optgroup>
<optgroup label="🧩 Mind and Behavior Studies Specializations">
    <option value="Behavioral Neuroscience" {{ $selectedValue == 'Behavioral Neuroscience' ? 'selected' : '' }}>Behavioral Neuroscience</option>
 
</optgroup>