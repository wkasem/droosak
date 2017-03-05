let Badge = function(user){


  switch (parseInt(user.type_id) ) {
    case 1:
      return '<span class="tag is-warning">'+Locale.get('badges_admin')+'</span>';
    case 2:
      return '<span class="tag is-primary">'+Locale.get('badges_teacher')+'</span>';
    case 3:
      return '<span class="tag is-success">'+Locale.get('badges_student')+'</span>';
  }

}

window.Badge = Badge;
