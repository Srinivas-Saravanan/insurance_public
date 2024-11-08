<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($add) ? esc($add) : esc($edit) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
            transition: margin-left 0.3s; 
        }

        .sidebar.hidden {
            margin-left: -200px; 
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px; 
        }

        .content.hidden {
            margin-left: 0; 
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {
                float: left;
            }
            div.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }
    </style>
</head>
<body>
<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?> 
    <div class="content">
        <h4><?= isset($add) ? esc($add) : esc($edit) ?> Family Member <?= isset($add) ? 'of family code ' . esc($familyCode) : esc($name) ?></h4>
        
        <form id="familyMemberForm" action="<?= isset($add) ? base_url('home/edAdder/'.esc($familyCode)) : base_url('home/edAdder/'.esc($familyCode).'/'.$name) ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($name) ? esc($name) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="relationship">Relationship:</label>
                <select class="form-control" id="relationship" name="relationship" required>
                    <option value="self" <?= isset($name2) && $name2['relationship'] === 'self' ? 'selected' : ''; ?>>Self</option>
                    <option id = "spouse" value="spouse" <?= isset($name2) && $name2['relationship'] === 'spouse' ? 'selected' : ''; ?>>Spouse</option>
                    <option id = "children" value="children" <?= isset($name2) && $name2['relationship'] === 'son' ? 'selected' : ''; ?>>Son</option>
                    <option id = "children" value="children" <?= isset($name2) && $name2['relationship'] === 'daughter' ? 'selected' : ''; ?>>Daughter</option>
                    <option value="mother" <?= isset($name2) && $name2['relationship'] === 'mother' ? 'selected' : ''; ?>>Mother</option>
                    <option value="father" <?= isset($name2) && $name2['relationship'] === 'father' ? 'selected' : ''; ?>>Father</option>
                    <option value="Parent In Law" <?= isset($name2) && $name2['relationship'] === 'parentInLaw' ? 'selected' : ''; ?>>Mother in law</option>
                    <option value="parentInLaw" <?= isset($name2) && $name2['relationship'] === 'parentInLaw' ? 'selected' : ''; ?>>Father In Law</option>
                </select>
            </div>
            <input type="hidden" name='function' value="<?= isset($add) ? esc($add) : esc($edit) ?>">
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" autocomplete="off" value="<?= isset($name2) ? date('Y-m-d', strtotime($name2['dob'])) : ''; ?>" required>
                <div id="ageError" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="male" <?= isset($name2) && $name2['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?= isset($name2) && $name2['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?= isset($name2) && $name2['gender'] === 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><?= isset($add) ? 'Add' : 'Save'; ?></button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
    var rules = <?= $rules ?>;
    var relationshipDropdown = $('#relationship');
    relationshipDropdown.empty();
        var elders = ['mother','father','motherInLaw','fatherInLaw'];
    var currentRelationship = '<?= isset($name2) ? esc($name2['relationship']) : '' ?>';
    var existingRelation = <?= json_encode($name2['existingRelation']); ?>;

    var existingCounts = {};
    $.each(rules, function (key) {
        existingCounts[key] = existingRelation.filter(rel => rel.relationship === key).length;
    });

    $.each(rules, function (key, rule) {
        if(key === currentRelationship){
            relationshipDropdown.append('<option value="' + key + '"' + 
                    (currentRelationship === key ? ' selected' : '') + '>' + 
                    key.charAt(0).toUpperCase() + key.slice(1) + '</option>');
                
        }
        if (rule.allowed && (existingCounts[key] < rule.allowedMembers || rule.allowedMembers === null)) {
            if (key === 'children') {
                if (existingCounts['children'] < 2) {
                    relationshipDropdown.append('<option value="children" ' + 
                        (currentRelationship === 'son' ? 'selected' : '') + '>Son</option>');
                    relationshipDropdown.append('<option value="children" ' + 
                        (currentRelationship === 'daughter' ? 'selected' : '') + '>Daughter</option>');
                }
            } else if (elders.includes(key)) {
                console.log("the sum is " + (existingCounts['mother'] + existingCounts['father']));
                console.log("allowed count is " + rules['allowedElders']['parentsAllowed']);
                if (rules['allowedElders']['cross'] === 0){
                    console.log("cross is 0");
                if (existingCounts['mother'] + existingCounts['father'] < rules['allowedElders']['parentsAllowed']) {
                    if (existingCounts['mother'] < rules['mother']['allowedMembers']) {
                        relationshipDropdown.append('<option value="mother" ' + 
                            (currentRelationship === 'mother' ? 'selected' : '') + '>Mother</option>');
                    }
                    if (existingCounts['father'] < rules['father']['allowedMembers']) {
                        relationshipDropdown.append('<option value="father" ' + 
                            (currentRelationship === 'father' ? 'selected' : '') + '>Father</option>');
                    }
                    return false;
                }
                if (existingCounts['motherInLaw'] + existingCounts['fatherInLaw'] < rules['allowedElders']['parenrInLawAllowed']){
                if (existingCounts['motherInLaw'] < rules['motherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="motherInLaw" ' + 
                        (currentRelationship === 'motherInLaw' ? 'selected' : '') + '>Mother-in-law</option>');
                }
                if (existingCounts['fatherInLaw'] < rules['fatherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="fatherInLaw" ' + 
                        (currentRelationship === 'fatherInLaw' ? 'selected' : '') + '>Father-in-law</option>');
                }
            }

            }
            else if (rules['allowedElders']['cross'] === 1){
                console.log("cross is 1");
                var parents = (existingCounts['mother']+existingCounts['father']);
                console.log(parents)
                var parentInLaw = (existingCounts['motherInLaw']+existingCounts['fatherInLaw']);
                if (parents === 0 && parentInLaw === 0){
                    if (existingCounts['mother'] < rules['mother']['allowedMembers']) {
                        relationshipDropdown.append('<option value="mother" ' + 
                            (currentRelationship === 'mother' ? 'selected' : '') + '>Mother</option>');
                    }
                    if (existingCounts['father'] < rules['father']['allowedMembers']) {
                        relationshipDropdown.append('<option value="father" ' + 
                            (currentRelationship === 'father' ? 'selected' : '') + '>Father</option>');
                    }
                    if (existingCounts['motherInLaw'] < rules['motherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="motherInLaw" ' + 
                        (currentRelationship === 'motherInLaw' ? 'selected' : '') + '>Mother-in-law</option>');
                }
                if (existingCounts['fatherInLaw'] < rules['fatherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="fatherInLaw" ' + 
                        (currentRelationship === 'fatherInLaw' ? 'selected' : '') + '>Father-in-law</option>');
                }
                return false;
                }
                else if(parents>0){
                    if (existingCounts['mother'] < rules['mother']['allowedMembers']) {
                        relationshipDropdown.append('<option value="mother" ' + 
                            (currentRelationship === 'mother' ? 'selected' : '') + '>Mother</option>');
                    }
                    if (existingCounts['father'] < rules['father']['allowedMembers']) {
                        relationshipDropdown.append('<option value="father" ' + 
                            (currentRelationship === 'father' ? 'selected' : '') + '>Father</option>');
                    }
                    return false;
                }
                else if(parentInLaw>0){
                    if (existingCounts['motherInLaw'] < rules['motherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="motherInLaw" ' + 
                        (currentRelationship === 'motherInLaw' ? 'selected' : '') + '>Mother-in-law</option>');
                }
                if (existingCounts['fatherInLaw'] < rules['fatherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="fatherInLaw" ' + 
                        (currentRelationship === 'fatherInLaw' ? 'selected' : '') + '>Father-in-law</option>');
                }
                return false;
                }
            }

            else if (rules['allowedElders']['cross'] === 2){
               console.log("cross is 2")
               console.log((existingCounts['mother']+existingCounts['father']+existingCounts['motherInLaw']+existingCounts['fatherInLaw']));
               console.log(rules['allowedElders']['parentsAllowed']);
                if ((existingCounts['mother']+existingCounts['father']+existingCounts['motherInLaw']+existingCounts['fatherInLaw'])<rules['allowedElders']['parentsAllowed']){
                    if (existingCounts['motherInLaw'] < rules['motherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="motherInLaw" ' + 
                        (currentRelationship === 'motherInLaw' ? 'selected' : '') + '>Mother-in-law</option>');
                }
                if (existingCounts['fatherInLaw'] < rules['fatherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="fatherInLaw" ' + 
                        (currentRelationship === 'fatherInLaw' ? 'selected' : '') + '>Father-in-law</option>');
                }
                if (existingCounts['mother'] < rules['mother']['allowedMembers']) {
                        relationshipDropdown.append('<option value="mother" ' + 
                            (currentRelationship === 'mother' ? 'selected' : '') + '>Mother</option>');
                    }
                    if (existingCounts['father'] < rules['father']['allowedMembers']) {
                        relationshipDropdown.append('<option value="father" ' + 
                            (currentRelationship === 'father' ? 'selected' : '') + '>Father</option>');
                    }
                }
                return false;
            }
            else if (rules['allowedElders']['cross'] ===3){
                if ((existingCounts['mother']+existingCounts['father']+existingCounts['motherInLaw']+existingCounts['fatherInLaw'])<(rules['allowedElders']['parentsAllowed']+rules['allowedElders']['parentInLawAllowed'])){
                    if (existingCounts['mother'] < rules['mother']['allowedMembers']) {
                        relationshipDropdown.append('<option value="mother" ' + 
                            (currentRelationship === 'mother' ? 'selected' : '') + '>Mother</option>');
                    }
                    if (existingCounts['father'] < rules['father']['allowedMembers']) {
                        relationshipDropdown.append('<option value="father" ' + 
                            (currentRelationship === 'father' ? 'selected' : '') + '>Father</option>');
                    }
                    if (existingCounts['motherInLaw'] < rules['motherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="motherInLaw" ' + 
                        (currentRelationship === 'motherInLaw' ? 'selected' : '') + '>Mother-in-law</option>');
                }
                if (existingCounts['fatherInLaw'] < rules['fatherInLaw']['allowedMembers']) {
                    relationshipDropdown.append('<option value="fatherInLaw" ' + 
                        (currentRelationship === 'fatherInLaw' ? 'selected' : '') + '>Father-in-law</option>');
                }
                }
                return false;
            }
         } else if (key!='self') {
                relationshipDropdown.append('<option value="' + key + '"' + 
                    (currentRelationship === key ? ' selected' : '') + '>' + 
                    key.charAt(0).toUpperCase() + key.slice(1) + '</option>');
            }
        }
    });
});

        $('#relationship').on('change', function () {
            var relationship = $(this).val();
            var familyCode = <?=$familyCode?>;
            var selectedRelationship = $(this).val();
            var rules = <?= $rules ?>;

            $.ajax({
                url: '<?=base_url("home/valid")?>',
                method: 'get',
                data: { relationship: relationship, familyCode: familyCode },
                success: function (response) {
                    if (response.status === 'success') {
                        var ruleData = response.rules;
                        var minAge = ruleData[0];
                        var maxAge = ruleData[1];
                        var selfAge = ruleData[2];
                        var selfGender = ruleData[3];

                        $.each(rules, function (key, rule) {
                        console.log(key);
                            if (key === selectedRelationship){
                                if (rule.age_limitBelow === true){
                                    console.log("Inside For ageLimitBelow");
                                    maxAge = selfAge-18;
                                }
                                else if(rule.age_limitAbove === true){
                                    console.log('inside ageLimitAbove')
                                    minAge = selfAge+20;
                            }
                        }
                        });
                        var minDate = new Date();
                        var maxDate = new Date();
                        
                        minDate.setFullYear(minDate.getFullYear() - maxAge);
                        maxDate.setFullYear(maxDate.getFullYear() - minAge);

                        $('#dob').attr('min', minDate.toISOString().split('T')[0]);
                        $('#dob').attr('max', maxDate.toISOString().split('T')[0]);
                    }
                }
            });
        });
    
</script>
<?= $this->endSection('content');?>
<div class="form-group">
    <label for="relationship">Relationship:</label>
    <select class="form-control" id="relationship" name="relationship" required></select>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
