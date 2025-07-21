<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>New Student Application</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f8f9fa;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .email-container {
                max-width: 600px;
                margin: 30px auto;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: #fff;
                padding: 30px 20px 20px 20px;
                text-align: center;
            }
            .header h2 {
                margin: 0 0 10px 0;
                font-size: 2rem;
            }
            .header p {
                margin: 0;
                font-size: 1.1rem;
            }
            .content {
                padding: 30px 20px;
            }
            .info-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 25px;
            }
            .info-table th,
            .info-table td {
                text-align: left;
                padding: 8px 0;
            }
            .info-table th {
                color: #28a745;
                width: 180px;
                font-weight: 600;
            }
            .info-table td {
                color: #333;
            }
            .files-section {
                margin-bottom: 20px;
            }
            .files-section h4 {
                margin: 0 0 10px 0;
                color: #20c997;
                font-size: 1.1rem;
            }
            .file-link {
                display: inline-block;
                margin: 0 10px 10px 0;
                padding: 7px 15px;
                background: #e9ecef;
                color: #007bff;
                border-radius: 5px;
                text-decoration: none;
                font-size: 0.97rem;
                transition: background 0.2s;
            }
            .file-link:hover {
                background: #d4edda;
                color: #155724;
            }
            .footer {
                background: #f8f9fa;
                color: #888;
                text-align: center;
                padding: 18px 10px;
                font-size: 0.95rem;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <h2>🎓 New Student Application</h2>
                <p>
                    A new student application has been submitted via the
                    website.
                </p>
            </div>
            <div class="content">
                <table class="info-table">
                    <tr>
                        <th>Student Name:</th>
                        <td>{{ $data["student_name"] }}</td>
                    </tr>
                    <tr>
                        <th>KPSEA Index Number:</th>
                        <td>{{ $data["kpsea_index_number"] }}</td>
                    </tr>
                    <tr>
                        <th>Current Residence:</th>
                        <td>{{ $data["current_residence"] }}</td>
                    </tr>
                    <tr>
                        <th>Guardian/Parent Name:</th>
                        <td>{{ $data["guardian_name"] }}</td>
                    </tr>
                    <tr>
                        <th>Guardian/Parent Phone:</th>
                        <td>{{ $data["guardian_phone"] }}</td>
                    </tr>
                    <tr>
                        <th>Submitted At:</th>
                        <td>{{ $data["submitted_at"] }}</td>
                    </tr>
                </table>

                <div class="files-section">
                    <h4>Application Letter:</h4>
                    <a
                        href="{{ $storageUrl.$data['application_letter'] }}"
                        class="file-link"
                        target="_blank"
                        >View Application Letter</a
                    >
                </div>

                <div class="files-section">
                    <h4>Academic Certificates:</h4>
                    @if(is_array($data['academic_certificates']) &&
                    count($data['academic_certificates']))
                    @foreach($data['academic_certificates'] as $idx => $file)
                    <a
                        href="{{ $storageUrl.$file }}"
                        class="file-link"
                        target="_blank"
                        >Certificate {{ $idx + 1 }}</a
                    >
                    @endforeach @else
                    <span class="text-muted">N/A</span>
                    @endif
                </div>

                <div class="files-section">
                    <h4>Parent's Death Certificate(s):</h4>
                    @if(is_array($data['death_certificates']) &&
                    count($data['death_certificates']))
                    @foreach($data['death_certificates'] as $idx => $file)
                    <a
                        href="{{ $storageUrl.$file }}"
                        class="file-link"
                        target="_blank"
                        >Death Certificate {{ $idx + 1 }}</a
                    >
                    @endforeach @else
                    <span class="text-muted">N/A</span>
                    @endif
                </div>
            </div>
            <div class="footer">
                This email was sent from the St. Aloysius Gonzaga website
                student application form.<br />
                Please review the application and attached documents.
            </div>
        </div>
    </body>
</html>
