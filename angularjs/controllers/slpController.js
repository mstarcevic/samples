app.controller('SlpController', function($scope, SessionService, SlpService, $timeout) {

    var getSlpOutcomes = function() {
        var studentId         = SessionService.get('studentId');
        var skillDescriptorId = $scope.slpData.skillDescriptorId;
        $timeout(function(){
            $scope.$apply(function() {
                $scope.slpOutcomes = SlpService.getSlpOutcomes(studentId, skillDescriptorId);
            });
        }, 100);
    };

    getSlpOutcomes();

    $scope.slpStaticHeadings = {
        outcome: "Goal",
        comment: "Progress Description"
    };

    $scope.showSLPForm      = false;
    $scope.showUploadForm   = false;
    $scope.isComment        = false;
    $scope.showAddBtn       = true;
    $scope.fileSelectSwitch = 0;

    function processClick() {
        $scope.showSLPForm = true;
        $scope.showAddBtn  = false;
    }

    $scope.addClick = function(type, slpOutcome) {
        $scope.showUploadForm = false;
        $scope.editing        = false;
        $scope.outcome        = '';
        $scope.isComment      = (type == 'C');
        $scope.currData       = (type == 'C') ? slpOutcome : '';
        processClick();
    };

    $scope.editClick = function(slpOutcome) {
        $scope.showUploadForm = false;
        $scope.editing        = true;
        $scope.currData       = slpOutcome;
        $scope.outcome        = slpOutcome.outcome;
        if ($scope.outcome === 'Future Goal') { $scope.outcome = '' }
        $scope.isComment      = (slpOutcome.type == 'C');
        processClick();
    };

    $scope.deleteClick = function(slpOutcome) {
        $scope.showUploadForm = false; //Delete confirmation isn't requested at this stage, but better to clear nonetheless.
        var deleteObj = {};
        if (slpOutcome.type == 'O') {
            deleteObj = {
                slpOutcomeId: slpOutcome.actualId * -1,
                outcome:      slpOutcome.outcome
            };
            postSlpOutcome(deleteObj);
        }
        else if (slpOutcome.type == 'C') {
            deleteObj = {
                slpCommentId: slpOutcome.actualId * -1,
                comment:      slpOutcome.outcome
            };
            postSlpComment(deleteObj);
        }
        else if (slpOutcome.type == 'D') {
            deleteObj = {
                slpDocumentId: slpOutcome.actualId * -1,
                document:      slpOutcome.outcome
            };
            SlpService.deleteSlpDocument(deleteObj); 
            getSlpOutcomes();
            $scope.outcome = '';
        }
        else {
           alert('Unrecognised outcome type: ' + slpOutcome.type); //Shouldn't ever happen of course.
        };
    }

    $scope.uploadClick = function(slpOutcome) {
        $scope.showSLPForm    = false;
        $scope.fileSelectSwitch > 1 ? $scope.fileSelectSwitch-- : $scope.fileSelectSwitch++;
        $scope.showUploadForm = true;
        $scope.showAddBtn     = false;
        $scope.currData       = slpOutcome;
    };

    $scope.$on('uploadComplete', function(event, newValue) {
        getSlpOutcomes();
        $scope.outcome = '';
        $scope.addNoMore();
    });

    $scope.checkFields = function() {
        var ok = 0;
        if (angular.isDefined($scope.outcome)) {
            if ($scope.outcome.length > 0) {
                ok = 1;
            }
        }
        return ok;
    };

    $scope.slpFormSubmit = function() {
        if ($scope.isComment) {
            $scope.editing ? updateSlpComment() : addSlpComment();
        }
        else {
            $scope.editing ? updateSlpOutcome() : addSlpOutcome();
        }
    };

    $scope.addNoMore = function() {
        $scope.showSLPForm    = false;
        $scope.showUploadForm = false;
        $scope.showAddBtn     = true;
    };

    function addSlpOutcome() {
        SlpService.getCurrentDate()         //mick This should be from DataService...
            .then(function(currentDate){
                var addObj = {
                    skillDescriptorId: $scope.slpData.skillDescriptorId,
                    studentId:         SessionService.get('studentId'),
                    teacherId:         SessionService.get('teacherId'),
                    outcome:           $scope.outcome,
                    createdDate:       currentDate.currentDate
                };
                postSlpOutcome(addObj);
            });
    }

    function updateSlpOutcome() {
        var updObj = {
            slpOutcomeId: $scope.currData.actualId,
            outcome:      $scope.outcome
        };
        postSlpOutcome(updObj);
        $scope.addNoMore();  //this is causing screen flickering.
    }

    function postSlpOutcome(updObj) {
        var jsonData = JSON.stringify(updObj);
        var posted = SlpService.postSlpOutcome(jsonData);

            getSlpOutcomes();
            $scope.outcome = '';

    }

    function addSlpComment(){
        SlpService.getCurrentDate()
            .then(function(currentDate){
                var addObj = {
                    slpOutcomeId: $scope.currData.actualId,
                    teacherId:    SessionService.get('teacherId'),
                    comment:      $scope.outcome,
                    createdDate:  currentDate.currentDate
                };
                // Another way would have been to addSlpOutcome(), get the new id
                // and then to just post this comment as is. That method wouldn't
                // necessitate any extra work on the php side of things.
                // However, it would require too much of a restructure on this
                // side of things.
                if (angular.equals({}, $scope.currData)) {
                    addObj.skillDescriptorId = $scope.slpData.skillDescriptorId;
                    addObj.studentId         = SessionService.get('studentId');
                    addObj.outcome           = 'Future Goal';
                    postFuture(addObj);
                }
                else {
                    postSlpComment(addObj);
                }
            });
    }

    function updateSlpComment() {
        var updObj = {
            slpCommentId: $scope.currData.actualId,
            comment:      $scope.outcome
        };
        postSlpComment(updObj);
    }

    function postSlpComment(updObj) {
        var jsonData = JSON.stringify(updObj);
        var posted = SlpService.postSlpComment(jsonData);

        getSlpOutcomes();
        $scope.outcome = '';
        $scope.addNoMore();  

    }

    function postFuture(updObj) {
        var jsonData = JSON.stringify(updObj);
        var posted = SlpService.postFuture(jsonData);

        getSlpOutcomes();
        $scope.outcome = '';
        $scope.addNoMore(); 

    }

});
