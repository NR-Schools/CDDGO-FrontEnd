<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/MemberModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/MemberRepository.php";


class MemberService
{
    static function addMembers(int $studentId, Member $member): bool
    {
        return MemberRepository::createMember($studentId, $member);
    }

    static function getAllMembers(): array
    {
        return MemberRepository::getAllMembers();
    }

    static function removeMember(int $memberId)
    {
        return MemberRepository::deleteMember($memberId);
    }
}

?>