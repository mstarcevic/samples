<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/assessmentCodes', 'getAssessmentCodes');
$app->get('/students', 'getStudents');
$app->get('/nodes', 'getNodes');
$app->get('/teacher/:param', 'getTeacher');
$app->get('/student/:param', 'getStudent');
$app->get('/assessments/:param', 'getAssessments');
$app->get('/headings/:param', 'getHeadings');
$app->get('/skills/:param', 'getSkills');
$app->get('/slpOutcomes/:param', 'getSlpOutcomes');
$app->get('/slpCount/:param', 'getSlpCount');
$app->get('/currentDate', 'getCurrentDate');
$app->get('/config', 'getConfig');
$app->get('/control', 'getControl');
$app->get('/control', 'getControl');

if ($app->request->isPost() or $app->request->isPut()) {
    $resourceUri = $app->request->getResourceUri();
    if ($resourceUri == '/assessment') {
        $body = $app->request->getBody();
        updateAssessment($body);
    }
    elseif ($resourceUri == '/slpOutcome') {
        $body = $app->request->getBody();
        updateSlpOutcome($body);
    }
    elseif ($resourceUri == '/slpComment') {
        $body = $app->request->getBody();
        updateSlpComment($body);
    }
    elseif ($resourceUri == '/futureGoal') {
        $body = $app->request->getBody();
        insertFuture($body);
    }
    elseif ($resourceUri == '/slpUpload') {
        uploadSlpDocument();
    }
}

if ($app->request->isDelete()) {
    $resourceUri = $app->request->getResourceUri();
    if ($resourceUri == '/assessment') {
        $body = $app->request->getBody();
        deleteAssessment($body);
    }
    elseif ($resourceUri == '/slpDocument') {
        $body = $app->request->getBody();
        deleteSlpDocument($body);
    }
}

function getStudents() {
    $dbh = getConnection();
    $sql = 'SELECT * FROM Student WHERE status=1';

    try {
        $q = $dbh->prepare($sql);  
        $q->execute();
        $students = $q->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($students);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getStudent($param) {
    $dbh = getConnection();
    $sql = "
        SELECT 
            studentId, casesId, firstName, lastName
        FROM 
            Student 
        WHERE 
            studentId=?
    ";

    try {
        $q = $dbh->prepare($sql);  
        $q->execute(array($param));  

        $student = $q->fetch(PDO::FETCH_OBJ);
        echo json_encode($student);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getNodes() {
    $dbh = getConnection();
    $sql = '
        SELECT DISTINCT
            Subject.subjectId,
            Subject.name as subjectName,
            Strand.strandId,
            Strand.name as strandName
        FROM
            SkillDescriptor
            INNER JOIN SubStrand on SkillDescriptor.subStrandId=SubStrand.subStrandId
            INNER JOIN Strand on SubStrand.strandId=Strand.strandId
            INNER JOIN Subject on Strand.subjectId=Subject.subjectId
        ORDER BY Subject.sequenceNo, Subject.subjectId, Strand.sequenceNo, Strand.strandId
     ';

    try {
        $q = $dbh->prepare($sql);  
        $q->execute();
        $tree = $q->fetchAll(PDO::FETCH_OBJ);

        $nodes = '[';
        $currSubjectId = -1;

        foreach ($tree as $item) {
            addToNodes($nodes, $currSubjectId, $item);
        }
   
        $nodes .= ']}]';
        echo $nodes;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function addToNodes(&$nodes, &$currSubjectId, &$item) {
    $subjectId = $item->subjectId;
    if ($subjectId != $currSubjectId) {
        if ($currSubjectId != -1) {
            $nodes .= "]},";
        }
        $nodes .= "{\"nodeName\":\"$item->subjectName\",\"nodeId\":\"subject_$item->subjectId\",\"collapsed\":true,\"children\":[";
        $currSubjectId = $subjectId;
    } else {
        $nodes .= ",";
    }
    $nodes .= "{\"nodeName\":\"$item->strandName\",\"nodeId\":\"strand_$item->strandId\",\"children\":[]}";
} 

function getSkills($param) {
    $pieces    = explode('|', $param);
    $strandId  = $pieces[0];
    $studentId = $pieces[1];

    $dbh = getConnection();
    $sql = '
        SELECT 
            Level.levelId,
            Level.levelCode,
            Level.achievementStandard as standard,
            SubStrand.subStrandId,
            SubStrand.name,
            SkillDescriptor.skillDescriptorId,
            SkillDescriptor.description,
            SkillDescriptor.ausvelsRef,
            SkillDescriptor.slp,
            (SELECT
                COUNT(1)
            FROM
                SLPOutcome
            WHERE
                studentId=?
                AND SLPOutcome.skillDescriptorId=SkillDescriptor.skillDescriptorId
            ) AS noOfSlps,
            (SELECT 
                MAX(createdDate) 
             FROM 
                 SLPOutcome 
             WHERE 
                 studentId=? 
                 AND SLPOutcome.skillDescriptorId=SkillDescriptor.skillDescriptorId
            ) AS latestSlp
        FROM
            SkillDescriptor
            INNER JOIN SubStrand on SkillDescriptor.subStrandId=SubStrand.subStrandId
            INNER JOIN Level on SkillDescriptor.levelId=Level.levelId
        WHERE
            SubStrand.strandId=?
        ORDER BY Level.sequenceNo, SubStrand.sequenceNo, SkillDescriptor.sequenceNo
     ';

    try {
        $q = $dbh->prepare($sql);  
        $q->execute(array($studentId, $studentId, $strandId));
        $skillDescriptors = $q->fetchAll(PDO::FETCH_OBJ);

        $skills = '[';
        $currLevelId     = -1;
        $currSubStrandId = -1;

        foreach ($skillDescriptors as $skillDescriptor) {
            $skillDescriptor->standard    = utf8_encode($skillDescriptor->standard);
            $skillDescriptor->description = utf8_encode($skillDescriptor->description);
            addToSkills($skills, $currLevelId, $currSubStrandId, $skillDescriptor);
        }
   
        $skills .= ']}]}]';

        $skills= str_replace("\n", "\\n", $skills);
        $skills= str_replace("\r", "\\r", $skills);

        echo $skills;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getSlpOutcomes($param) {
    $pieces            = explode('|', $param);
    $studentId         = $pieces[0];
    $skillDescriptorId = $pieces[1];

    $dbh = getConnection();
    $sql = getSlpOutcomesSql();

    try {
        $q = $dbh->prepare($sql);  
        $q->execute(array($studentId, $skillDescriptorId));
        $slpOutcomes = $q->fetchAll(PDO::FETCH_OBJ);

        $outcomes = '[';
        $useId    = 0;

        foreach ($slpOutcomes as $slpOutcome) {
            addToOutcomes($outcomes, $slpOutcome, 'O', $useId, 0, 0);

            $slpComments = getSLPComments($slpOutcome->slpOutcomeId);
            $totComments = count($slpComments);

            $relatesToOutcome = $useId;

            $countComments = 0;

            foreach ($slpComments as $slpComment) {
                $countComments++;
                $isLastComment = ($countComments == $totComments) ? 1 : 0;
                addToOutcomes($outcomes, $slpComment, 'C', $useId, $relatesToOutcome, $isLastComment);

                $slpDocuments = getSLPDocuments($slpComment->slpCommentId);
                $totDocuments = count($slpDocuments);

                $relatesToComment = $useId; //No use is made of this now..

                $countDocuments = 0;

                foreach ($slpDocuments as $slpDocument) {
                    $countDocuments++;
                    $isLastDocument = ($countDocuments == $totDocuments) ? 1 : 0;
                    addToOutcomes($outcomes, $slpDocument, 'D', $useId, $relatesToOutcome, $isLastDocument);
                }
            }
        }
   
        $outcomes .= ']';
        echo $outcomes;

    } catch(PDOException $e) {
        error_log($e->getMessage()); 
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getConfig() {
    $dbh = getConnection();
    $sql = "SELECT appTitle, logoFilename, termForSubject, ausVelsURL FROM Config where configId=1";
    try {
        $q = $dbh->prepare($sql);  
        $q->execute();
        $config = $q->fetch(PDO::FETCH_OBJ);
        echo json_encode($config);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getControl() {
    $dbh = getConnection();
    $sql = "SELECT currentYear, currentTerm FROM Control where controlId=1";
    try {
        $q = $dbh->prepare($sql);  
        $q->execute();
        $control = $q->fetch(PDO::FETCH_OBJ);
        $control->maxFileUploadSize = getMaxFileUploadSize();
        echo json_encode($control);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function uploadSlpDocument() {
    $errmsg = '';

    if (!empty($_FILES) and !empty($_POST)) {

        $teacherId    = $_POST['teacherId'];
        $slpCommentId = $_POST['slpCommentId'];

        if ($teacherId and $slpCommentId) { // and $uploadedDate) {

            $filename     = $_FILES['file']['name'];
            $extension    = pathinfo($filename, PATHINFO_EXTENSION);
            $originalName = basename($filename, '.'.$extension);

            $dbh = getConnection();
            $sql = "
                INSERT into SLPDocument (
                    slpCommentId, teacherId, originalName, extension, filesize, uploadedDate
                ) 
                VALUES (
                    ?, ?, ?, ?, ?, NOW()
                )
            ";
            $myArray = array(
                $slpCommentId, 
                $teacherId, 
                $originalName,
                $extension,
                $_FILES['file']['size'] //,
            );

            try {
                $q = $dbh->prepare($sql);  
                $q->execute($myArray);

                $slpDocumentId = $dbh->lastInsertId();
            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            }
            
            $newFilename = $slpDocumentId.'.'.$extension;

            $tempPath = $_FILES['file']['tmp_name'];
            $uploadPath  = dirname( __FILE__ );
            $uploadPath .= DIRECTORY_SEPARATOR;
            $uploadPath .= '..';
            $uploadPath .= DIRECTORY_SEPARATOR;
            $uploadPath .= 'uploads';
            $uploadPath .= DIRECTORY_SEPARATOR;
            $uploadPath .= $newFilename;

            move_uploaded_file( $tempPath, $uploadPath );

            $answer = array( 'answer' => 'File transfer completed' );
            $json = json_encode( $answer );

            echo $json;
        } else {
            $errmsg = 'formData params incorrect.';
        }
    } else {
        $errmsg = 'No files and/or formData received!';
    }

    if ($errmsg) {
        error_log($errmsg);
        echo $errmsg;
    }
}

$app->run();

?>
