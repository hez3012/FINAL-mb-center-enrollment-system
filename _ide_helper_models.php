<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $log_id
 * @property int $user_id
 * @property string $action
 * @property string $table_name
 * @property int|null $record_id
 * @property string|null $changes
 * @property \Illuminate\Support\Carbon|null $timestamp
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditLog whereUserId($value)
 */
	class AuditLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $auth_log_id
 * @property int $user_id
 * @property string $action login or logout
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon $logged_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog whereAuthLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog whereLoggedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuthLog whereUserId($value)
 */
	class AuthLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int         $dev_ped_id
 * @property string      $first_name
 * @property string      $last_name
 * @property string      $clinic_hospital
 * @property string      $contact_number
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereClinicHospital($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereDevPedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentalPediatrician withoutTrashed()
 */
	class DevelopmentalPediatrician extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $disability_id
 * @property int $service_type_id
 * @property string $disability_name
 * @property string|null $description
 * @property string|null $deleted_at
 * @property-read \App\Models\ServiceType $serviceType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability whereDisabilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability whereDisabilityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disability whereServiceTypeId($value)
 */
	class Disability extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $document_type_id
 * @property string $document_name
 * @property bool $is_required
 * @property string|null $deleted_at
 * @property bool $is_active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType whereDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentType whereIsRequired($value)
 */
	class DocumentType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int                 $enrollment_id
 * @property int                 $student_id
 * @property int                 $school_year_id
 * @property int                 $program_level_id
 * @property \Carbon\Carbon      $enrollment_date
 * @property string              $enrollment_type
 * @property string              $status
 * @property bool                $waiver_signed
 * @property string|null         $rejection_reason
 * @property string|null         $remarks
 * @property int|null            $processed_by
 * @property \Carbon\Carbon      $created_at
 * @property \Carbon\Carbon      $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read string         $type_label
 * @property-read string         $status_label
 * @property-read string         $status_badge
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EnrollmentDocument> $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\User|null $processedBy
 * @property-read \App\Models\ProgramLevel|null $programLevel
 * @property-read \App\Models\SchoolYear|null $schoolYear
 * @property-read \App\Models\Student|null $student
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereEnrollmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereEnrollmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereEnrollmentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereProgramLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereSchoolYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment whereWaiverSigned($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment withoutTrashed()
 */
	class Enrollment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $enrollment_doc_id
 * @property string $submission_status
 * @property \Illuminate\Support\Carbon|null $submission_date
 * @property string|null $file_path
 * @property string|null $notes
 * @property int $enrollment_id
 * @property int $document_type_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\DocumentType $documentType
 * @property-read \App\Models\Enrollment|null $enrollment
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereEnrollmentDocId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereEnrollmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereSubmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument whereSubmissionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EnrollmentDocument withoutTrashed()
 */
	class EnrollmentDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $guardian_id
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string|null $contact_number
 * @property string $relationship
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereGuardianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Guardian whereUserId($value)
 */
	class Guardian extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int                 $payment_id
 * @property int                 $enrollment_id
 * @property float               $amount
 * @property \Carbon\Carbon      $payment_date
 * @property string              $payment_method
 * @property string              $or_number
 * @property string|null         $notes
 * @property int                 $recorded_by
 * @property \Carbon\Carbon      $created_at
 * @property \Carbon\Carbon      $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Models\Enrollment|null $enrollment
 * @property-read string $method_label
 * @property-read \App\Models\User|null $recordedBy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereEnrollmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereOrNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereRecordedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $permission_id
 * @property string $permission_name
 * @property string $category
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission wherePermissionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutTrashed()
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int    $program_level_id
 * @property string $program_name
 * @property string|null $description
 * @property int $max_capacity
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Enrollment> $enrollments
 * @property-read int|null $enrollments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel whereMaxCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel whereProgramLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProgramLevel whereProgramName($value)
 */
	class ProgramLevel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $role_id
 * @property string $role_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role withoutTrashed()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $school_year_id
 * @property string $year_label
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereSchoolYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereYearLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear withoutTrashed()
 */
	class SchoolYear extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $service_type_id
 * @property string $service_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Disability> $disabilities
 * @property-read int|null $disabilities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceType whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceType whereServiceTypeId($value)
 */
	class ServiceType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $student_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property \Illuminate\Support\Carbon $birthdate
 * @property string $sex
 * @property string|null $sex_specify
 * @property string|null $profile_picture
 * @property string|null $contact_number_1
 * @property string|null $contact_number_2
 * @property string|null $address
 * @property string $status
 * @property int $guardian_id
 * @property int|null $dev_ped_id
 * @property string|null $dev_ped_document
 * @property string|null $disability_other
 * @property int|null $service_type_id
 * @property int|null $disability_id
 * @property int|null $program_level_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $region
 * @property string|null $province
 * @property string|null $city
 * @property string|null $house_unit_no
 * @property string|null $street
 * @property string|null $barangay
 * @property string|null $zip_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DevelopmentalPediatrician|null $developmentalPediatrician
 * @property-read \App\Models\Disability|null $disability
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Enrollment> $enrollments
 * @property-read int|null $enrollments_count
 * @property-read int $age
 * @property-read string $full_address
 * @property-read string $full_name
 * @property-read string $list_name
 * @property-read string $middle_initial
 * @property-read \App\Models\Guardian $guardian
 * @property-read \App\Models\ProgramLevel|null $programLevel
 * @property-read \App\Models\ServiceType|null $serviceType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereBarangay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereContactNumber1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereContactNumber2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereDevPedDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereDevPedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereDisabilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereDisabilityOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereGuardianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereHouseUnitNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereProgramLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereServiceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSexSpecify($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student withoutTrashed()
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int                 $user_id
 * @property string              $first_name
 * @property string|null         $middle_name
 * @property string              $last_name
 * @property string|null         $sex
 * @property string|null         $sex_specify
 * @property \Carbon\Carbon|null $birthdate
 * @property string|null         $contact_number_1
 * @property string|null         $contact_number_2
 * @property string|null         $region
 * @property string|null         $province
 * @property string|null         $city
 * @property string|null         $barangay
 * @property string|null         $house_unit_no
 * @property string|null         $street
 * @property string|null         $zip_code
 * @property string              $email
 * @property string              $username
 * @property string              $password
 * @property int                 $role_id
 * @property string|null         $profile_picture
 * @property bool                $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read string         $full_name
 * @property-read string         $list_name
 * @property-read string         $middle_initial
 * @property-read string         $full_address
 * @property-read string         $sex_display
 * @property-read int|null       $age
 * @property-read \App\Models\Role|null                    $role
 * @property-read \Illuminate\Database\Eloquent\Collection $permissions
 * @property-read \App\Models\Guardian|null                $guardian
 * @property string|null $facebook_link
 * @property int $failed_attempts
 * @property string|null $locked_until
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBarangay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereContactNumber1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereContactNumber2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFailedAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereHouseUnitNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLockedUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSexSpecify($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

